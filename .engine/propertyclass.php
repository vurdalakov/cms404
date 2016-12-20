<?php

// http://php.net/manual/en/language.oop5.overloading.php
// http://php.net/manual/en/class.reflectionclass.php

class PropertyClass
{
	public function __construct($fileOrDirectoryName)
	{
        $this->properties = array();
    }

    public function __get($name)
    {
        try
        {
            return $this->getReflectionProperty($name)->getValue($this);
        }
        catch (Exception $ex)
        {
            return $this->getProperty($name);
        }
    }

    public function __set($name, $value)
    {
        try
        {
            $this->getReflectionProperty($name)->setValue($this, $value);
        }
        catch (Exception $ex)
        {
            $this->setProperty($name, $value);
        }
    }

    private function getReflectionProperty($propertyName)
    {
        $class = new ReflectionClass($this);
        $property = $class->getProperty("_$propertyName");
        $property->setAccessible(true);
        return $property;
    }
    
    private $properties;
    
    protected function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }
    
    protected function setProperties($properties)
    {
        foreach ($properties as $name => $value)
        {
            $this->setProperty($name, $value);
        }
    }
    
    protected function getProperty($name, $defaultValue = null)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : $defaultValue;
    }
}

?>
