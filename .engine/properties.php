<?php

class Properties
{
	private $props;

	public function __construct($fileOrDirectoryName)
	{
        $this->props = array();
        
        if (is_file($fileOrDirectoryName))
        {
            $this->readFile($fileOrDirectoryName);
        }
        else
        {
            $fileOrDirectoryName = combinePath($fileOrDirectoryName, '.folder');
            if (is_file($fileOrDirectoryName))
            {
                $this->readFile($fileOrDirectoryName);
            }

            $fileOrDirectoryName = combinePath($fileOrDirectoryName, 'index.md');
            if (is_file($fileOrDirectoryName))
            {
                $this->readFile($fileOrDirectoryName);
            }
        }
    }

    public function getAll()
    {
        return $this->props;
    }

    public function get($name, $defaultValue = "")
    {
        return isset($this->props[$name]) ? $this->props[$name] : $defaultValue;
    }

    private function readFile($fileName)
    {
        if (!is_file($fileName))
        {
            return;
        }

        $text = readTextFile($fileName);

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line)
        {
            $line = trim($line);
            
            if (0 !== strpos($line, '$'))
            {
                break;
            }
            
            $line = substr($line, 1);
            
            $parts = explode('=', $line);
            if (count($parts) != 2)
            {
                continue;
            }
            
            $this->props[trim($parts[0])] = trim($parts[1]);
        }

        if (empty($this->props['title']))
        {
            foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line)
            {
                if (0 === strpos($line, '# '))
                {
                    $this->props['title'] = trim(substr($line, 2));
                    break;
                }
            }
        }
    }
}

?>
