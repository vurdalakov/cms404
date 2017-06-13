<?php

function appendSlash($path)
{
    return rtrim($path, '/') . '/';
}

function combinePath($path1, $path2)
{
    return appendSlash($path1) . ltrim($path2, '/');
}

function changeExtension($fileName, $newExtension)
{
    $info = pathinfo($fileName);
    return $info['dirname'] . '/' . $info['filename'] . '.' . ltrim($newExtension, '.');
}

function readTextFile($fileName)
{
    $fileName = htmlspecialchars($fileName);
    
    if (!is_file($fileName))
    {
        return "";
    }
    
    $text = file_get_contents(htmlspecialchars($fileName));
    if (substr($text, 0, 3) == "\xEF\xBB\xBF")
    {
        $text = substr($text, 3);
    }
    return $text;
}

function isNullOrWhitespace($string)
{
    return !isset($string) or is_null($string) or ('' === trim($string));
}
?>
