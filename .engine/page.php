<?php

require_once('propertyclass.php');
require_once('properties.php');

class Page extends PropertyClass
{
	private $_title;
	private $_content;

	function __construct($fileName)
	{
        $fileNameParts = pathinfo($fileName);
        
        $props = new Properties($fileName);
        $this->_title = $props->get('title', $fileNameParts['filename']);

        $text = readTextFile($fileName);

		$this->_content = "";

        $append = false;
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line)
        {
            if (!$append && (strlen($line) > 2) && ('$' === $line[0]))
            {
                continue;
			}
            
            $append = true;
            
            $this->_content .= "$line\n";
        }
    }
}

?>
