<?php

require_once('propertyclass.php');

class Page extends PropertyClass
{
	private $_title;
	private $_content;

	function __construct($fileName)
	{
        $text = readTextFile($fileName);

		$this->_content = "";

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line)
        {
            $line = trim($line);
            
            if (0 === strpos($line, '# '))
            {
				if (empty($this->_title))
				{
					$this->_title = trim(substr($line, 2));
				}
			}
            else if (0 === strpos($line, '$title='))
            {
				$this->_title = trim(substr($line, 7));
                continue;
			}
            
            $this->_content .= "$line\n";
        }
    }
}

?>
