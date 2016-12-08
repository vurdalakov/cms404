<?php

require_once('engine.php');
require_once('page.php');
require_once('Parsedown.php');

function replaceTag(&$text, $tag, $value)
{
    $tag = sprintf('$$(%s)', $tag);
    
    if (strpos($text, $tag) !== false)
    {
        $text = str_replace($tag, $value, $text);
    }
    
    return $text;
}

function replaceTags($text, $engine, $page)
{
    replaceTag($text, "PAGE_TITLE", $page->title);
    replaceTag($text, "PAGE_URL", $engine->pageUrl);
    replaceTag($text, "SITE_AUTHOR", $engine->siteAuthor);
    replaceTag($text, "SITE_TITLE", $engine->siteTitle);
    replaceTag($text, "SITE_URL", $engine->rootUrl);
    replaceTag($text, "THIS_YEAR", $engine->thisYear);

    if (preg_match('/\$\$\(INCLUDE,(.+?)\)/', $text, $matches))
    {
        $include = $engine->readTextFile($matches[1]);
        $text = str_replace($matches[0], $include, $text);
    }
    
    return $text;
}

$engine = new Engine();

$page = new Page($engine->pageFilePath);

$md = replaceTags($page->content, $engine, $page);
$html = Parsedown::instance()->text($md);

$template = $engine->readTextFile(".engine/template.htm"); // TODO: from props

$template = replaceTags($template, $engine, $page);
replaceTag($template, "PAGE_CONTENT", $html);

echo $template;
?>
