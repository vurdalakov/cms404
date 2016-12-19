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

   	function fileList($path = null)
	{
        $files = $this->getFileList($this->makeDir($path), $this->makeUrl($path));

		return $this->makeBulletList($files);
    }

    private function getFileList($folderDir, $folderUrl)
	{
        $files = array();

        $items = scandir($folderDir);
        foreach ($items as $index => $itemName)
        {
            $itemPath = combinePath($folderDir, $itemName);
            if (is_file($itemPath) && ('md' == pathinfo($itemPath, PATHINFO_EXTENSION)) && ('index.md' != pathinfo($itemPath, PATHINFO_BASENAME)))
            {
                $file = array("name"=>$itemName, "path"=>$itemPath);

                $props = new Properties($itemPath);
                
                $file['title'] = $props->get('title', $itemName);
                $file['order'] = $props->get('order', -1);

                $file['url'] = changeExtension(combinePath($folderUrl, $itemName), '.htm');

                $files[$file['title']] = $file;
            }
        }

        ksort($files);
        
        return $files;
    }
    
   	function allFilesList($path = null)
	{
        $files = array();
        
        $this->getAllFilesList($this->makeDir($path), $this->makeUrl($path), $files);

        ksort($files);
        
		return $this->makeBulletList($files);
    }

   	private function getAllFilesList($folderDir, $folderUrl, &$files)
	{
        $folders = $this->getFolderList($folderDir, $folderUrl);
        
        foreach ($folders as $index => $folder)
        {
            $folderDir = $folder['path'];
            $folderUrl = $folder['url'];
            
            $files = array_merge($files, $this->getFileList($folderDir, $folderUrl));
            
            $this->getAllFilesList($folderDir, $folderUrl, $files);
        }
    }

   	function folderList($path = null)
	{
        $folders = $this->getFolderList($this->makeDir($path), $this->makeUrl($path));

		return $this->makeBulletList($folders);
    }

    private function getFolderList($folderDir, $folderUrl)
	{
        $folders = array();

        $items = scandir($folderDir);
        foreach ($items as $index => $itemName)
        {
            if ($itemName[0] == '.')
            {
                continue;
            }
            
            $itemPath = combinePath($folderDir, $itemName);
            if (is_dir($itemPath))
            {
                $folder = array('name'=>$itemName, 'path'=>$itemPath);

                $props = new Properties($itemPath);
                
                $folder['title'] = $props->get('title', $itemName);
                $folder['order'] = $props->get('order', -1);

                $folder['url'] = combinePath($folderUrl, $itemName);

                $index = $folder['order'] >= 0 ? $folder['order'] : 1000000 + count($folders);
                
                $folders[$index] = $folder;
            }
        }

        ksort($folders);
        
        return $folders;
    }
    
    private function makeDir($path)
    {
        return  is_null($path) ? $this->pageDir : combinePath($this->rootDir, $path);
    }
    
    private function makeUrl($path)
    {
        return is_null($path) ? dirname($this->pageUrl) : combinePath($this->rootUrl, $path);
    }

    private function makeBulletList($items)
    {
        $md = '';

        foreach ($items as $index => $item)
        {
            $md .= '- [' . $item['title'] . '](' . $item['url'] . ")\n";
        }

		return $md;
    }
}

?>
