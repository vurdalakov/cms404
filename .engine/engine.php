<?php

require_once('propertyclass.php');
require_once('common.php');
require_once('properties.php');

class Engine extends PropertyClass
{
	private $_rootUrl;
	private $_rootDir;
	private $_pageFilePath;
	private $_pageUrl;
	private $_pageDir;

	function __construct()
	{
//print_r($_SERVER);echo "<br/>\n";

        $this->rootUrl = $_SERVER['SCRIPT_NAME'];
        $this->rootDir = $_SERVER['SCRIPT_FILENAME'];
        $pos = strpos($this->rootDir, '/', strlen($this->rootDir) - strlen($this->rootUrl) + 1);
        $this->rootDir = substr($this->rootDir, 0, $pos);
        $this->rootUrl = dirname(dirname($this->rootUrl));
//echo "rootDir='" . $this->rootDir . "'<br/>rootUrl='" . $this->rootUrl . "'<br/>\n";

        $propsFileName = combinePath($this->rootDir, ".config");
        $props = new Properties($propsFileName);
        $this->setProperties($props->getAll());

        $this->pageUrl = $_SERVER['REDIRECT_URL'];
        $this->pageUrl = changeExtension($this->pageUrl, "htm");
//echo "pageUrl='" . $this->pageUrl . "'<br/>\n";

        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $this->pageFilePath = combinePath($documentRoot, $this->pageUrl);
        $this->pageFilePath = changeExtension($this->pageFilePath, "md");
//echo "pageFilePath='" . $this->pageFilePath . "'<br/>\n";
        if (!is_file($this->pageFilePath))
        {
            $this->pageFilePath = combinePath($this->rootDir, $this->error404);
        }
//echo "pageFilePath='" . $this->pageFilePath . "'<br/>\n";

        $this->pageDir = dirname($this->pageFilePath);
//echo "pageDir='" . $this->pageDir . "'<br/>\n";

        $this->setProperty("thisYear", date("Y"));
    }

	function readTextFile($fileName)
	{
		return readTextFile(combinePath($this->rootDir, $fileName));
	}
}

?>
