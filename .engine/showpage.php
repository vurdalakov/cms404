<?php

require_once('engine.php');
require_once('page.php');
require_once('Parsedown.php');
require_once('ParsedownExtra.php');
require_once('ParsedownExtensions.php');

function parsedown($text)
{
    static $parsedown;
    
    if (!isset($parsedown))
    {
        $parsedown = new ParsedownExtensions();
    }
    
    return $parsedown->text($text);
}

function replaceTag($text, $tag, $value)
{
    return preg_replace_callback(sprintf('/(?<=^|[^\\\\])\$\$[({]\s*%s\s*[)}]/', $tag),
        function ($matches) use($value) { return strpos($matches[0], '$${') !== false ? parsedown($value) : $value; },
        $text);

    // Disable eAccelerator PHP extension if you get the following error:
    // preg_replace_callback(): Requires argument 2, '', to be a valid callback
    // https://github.com/eaccelerator/eaccelerator/issues/12
}

function replaceTagExt($text, $tag, $callback)
{
    return preg_replace_callback(sprintf('/(?<=^|[^\\\\])\$\$[({]\s*%s\s*,\s*(.+?)\s*[)}]/', $tag),
        function ($matches) use($callback) { $result = call_user_func($callback, $matches); return strpos($matches[0], '$${') !== false ? parsedown($result) : $result; },
        $text);
}

function replaceTags($text, $engine, $page)
{
    $text = replaceTag($text, "PAGE_TITLE", $page->title);
    $text = replaceTag($text, "PAGE_URL", $engine->pageUrl);
    $text = replaceTag($text, "SITE_AUTHOR", $engine->siteAuthor);
    $text = replaceTag($text, "SITE_TITLE", $engine->siteTitle);
    $text = replaceTag($text, "SITE_URL", $engine->rootUrl);
    $text = replaceTag($text, "THIS_YEAR", $engine->thisYear);
    $text = replaceTag($text, "FOLDER_LIST", $engine->folderList());
    $text = replaceTag($text, "PAGE_LIST", $engine->fileList());
    $text = replaceTag($text, "PAGE_LIST_ALL", $engine->allFilesList());

    $text = replaceTagExt($text, 'INCLUDE', function ($matches) use ($engine) { return $engine->readTextFile($matches[1]); });
    $text = replaceTagExt($text, 'FOLDER_LIST', function ($matches) use ($engine) { return $engine->folderList($matches[1]); });
        
    return $text;
}

$engine = new Engine();

$page = new Page($engine->pageFilePath);

if (isset($_GET['source']))
{
    $html = "<pre>\r\n" . htmlspecialchars(readTextFile($engine->pageFilePath)) . "</pre>\r\n";
}
else
{
    $md = replaceTags($page->content, $engine, $page);
    $html = parsedown($md);
}

$template = $engine->readTextFile($engine->templateFileName);

$template = replaceTags($template, $engine, $page);
$content = replaceTag($template, "PAGE_CONTENT", $html);

if (!isset($_GET['source']))
{
    $content = str_replace('\$$(', '$$(', str_replace('\$${', '$${', $content));
}

echo $content;
?>
