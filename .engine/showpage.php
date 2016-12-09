<?php

require_once('engine.php');
require_once('page.php');
require_once('Parsedown.php');

function replaceTag($text, $tag, $value)
{
    return preg_replace(sprintf('/(?<=^|[^\\\\])(\$\$\(%s\))/', $tag), $value,  $text);
}

function replaceTags($text, $engine, $page)
{
    $text = replaceTag($text, "PAGE_TITLE", $page->title);
    $text = replaceTag($text, "PAGE_URL", $engine->pageUrl);
    $text = replaceTag($text, "SITE_AUTHOR", $engine->siteAuthor);
    $text = replaceTag($text, "SITE_TITLE", $engine->siteTitle);
    $text = replaceTag($text, "SITE_URL", $engine->rootUrl);
    $text = replaceTag($text, "THIS_YEAR", $engine->thisYear);

    return preg_replace_callback('/(?<=^|[^\\\\])\$\$\(\s*INCLUDE\s*,\s*(.+?)\s*\)/',
        function ($matches) use ($engine) { return $engine->readTextFile($matches[1]); },
        $text);
}

$engine = new Engine();

$page = new Page($engine->pageFilePath);

$md = replaceTags($page->content, $engine, $page);
$html = Parsedown::instance()->text($md);

$template = $engine->readTextFile($engine->templateFileName);

$template = replaceTags($template, $engine, $page);
$content = replaceTag($template, "PAGE_CONTENT", $html);

echo str_replace('\$$(', '$$(', $content);
?>
