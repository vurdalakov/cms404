<?php

require_once('propertyclass.php');
require_once('common.php');
require_once('properties.php');

class Updater extends PropertyClass
{
	private $_rootUrl;
	private $_rootDir;
    private $_subject;
    private $_output;
    private $_url;
    
    function __construct()
	{
        $this->rootUrl = $_SERVER['SCRIPT_NAME'];
        $this->rootDir = $_SERVER['SCRIPT_FILENAME'];
        $pos = strpos($this->rootDir, '/', strlen($this->rootDir) - strlen($this->rootUrl) + 1);
        $this->rootDir = substr($this->rootDir, 0, $pos);
        $this->rootUrl = dirname(dirname($this->rootUrl));

        $propsFileName = combinePath($this->rootDir, ".config");
        $props = new Properties($propsFileName);
        $this->setProperties($props->getAll());

        $this->_url = combinePath($_SERVER['HTTP_HOST'], $this->rootUrl);
        $this->_subject = 'POST: ' . $this->_url;
        $this->_url = 'http://' . $this->_url;

        $this->_output = array();
    }
    
    public function update()
    {
        if (!isset($_GET['tag']) or ($_GET['tag'] != $this->gitTag))
        {
            $error = '403 Access Denied';
            $this->email($error, '');
            header("HTTP/1.1 $error");
            exit;
        }

        // start

        echo "<pre>\r\n";

        $this->stdout('-----------------------');
        $this->stdout(date('d.m.Y H:i:s'));
        $this->stdout('-----------------------');

        // call git

        $git = $this->gitPath;

        $this->exec("$git --version");

        $this->stdout('-----------------------');

        $this->exec("$git fetch --all && $git reset --hard");

        // all done

        $this->stdout('-----------------------');
        $this->stdout(date('d.m.Y H:i:s'));
        $this->stdout('-----------------------');

        // mail

        $body = implode("\r\n", $this->_output) . "\r\n\r\n" . $this->_url . "\r\n";

        $this->email('200 OK', $body);

        echo "Email sent\r\n";
        echo "-----------------------\r\n";

        echo sprintf("</pre>\r\n<br/>\r\n<a href='%s'>%s</a><br/>\r\n", $this->_url, $this->_url);
    }
    
    private function email($result, $body)
    {
        if (isNullOrWhitespace($this->adminEmail))
        {
            return;
        }

        mail($this->adminEmail, sprintf("%s (%s)", $this->_subject, $result), $body);
    }

    private function exec($command)
    {
        $output = array();
        $result = -1;
        
        exec("$command 2>&1", $output, $result);
        
        $this->stdout("'$command' returned status code '$result'");
        
        foreach ($output as $line)
        {
            $this->stdout($line);
        }
    }

    private function stdout($line)
    {
        echo "$line\r\n";
        array_push($this->_output, $line);
    }
}

$updater = new Updater();
$updater->Update();

?>