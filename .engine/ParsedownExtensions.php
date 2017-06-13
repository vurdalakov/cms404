<?php

class ParsedownExtensions extends ParsedownExtra
{
    const version = '0.1.0';

    function __construct()
    {
        if (parent::version < '0.7.0')
        {
            throw new Exception('ParsedownExtensions requires a later version of ParsedownExtra');
        }
    }

    protected function inlineEscapeSequence($Excerpt)
    {
        if (isset($Excerpt['text'][1]) and ('\\' == $Excerpt['text'][1]) and isset($Excerpt['text'][2]) and ("\n" == $Excerpt['text'][2]))
        {
            return array(
                'markup' => "<br />\n",
                'extent' => 3,
            );
        }

        return parent::inlineEscapeSequence($Excerpt);
    }
}
