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

		parent::__construct();
        
        $this->BlockTypes['%'] []= 'Epigraph';

        // Backslash Escapes
        
        $this->specialCharacters []= ':';
        $this->specialCharacters []= '%';
    }
    
    // Hard line break

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
    
    // Epigraph

    protected function blockEpigraph($Line)
    {
        if ((strlen($Line['text']) > 2) and (' ' == $Line['text'][1]))
        {
            $text = substr($Line['text'], 2);

            $Block = array(
                'element' => array(
                    'name' => 'p',
                    'attributes' => array(
                        'class' => 'pde-epigraph',
                    ),
                    'text' => $text,
                    'handler' => 'line',
                ),
            );

            return $Block;
        }
    }

    protected function blockEpigraphContinue($Line, $Block)
    {
        if (isset($Block['complete']))
        {
            return;
        }

        if (isset($Block['interrupted']))
        {
            unset($Block['interrupted']);

            $Block['complete'] = true;

            return;
        }

        $Block['element']['text'] .= "\n";
        $Block['element']['text'] .= $Line['text'];

        return $Block;
    }
    
    // Image alignment + image title

    // https://stackoverflow.com/questions/619610/whats-the-most-efficient-test-of-whether-a-php-string-ends-with-another-string
    private function endsWith($string, $test)
    {
        $strlen = strlen($string);
        $testlen = strlen($test);
        
        if ($testlen > $strlen)
        {
            return false;
        }
        
        return 0 === substr_compare($string, $test, $strlen - $testlen, $testlen);
    }
    
    protected function inlineImage($Excerpt)
    {
        $Inline = parent::inlineImage($Excerpt);
        
        $alt = $Inline['element']['attributes']['alt'];
        
        if ($this->endsWith($alt, ' <>'))
        {
            $Inline['element']['attributes']['class'] = 'pde-img-center';
            $alt = substr($alt, 0, strlen($alt) - 3);
        }
        else if ($this->endsWith($alt, ' >'))
        {
            $Inline['element']['attributes']['class'] = 'pde-img-right';
            $alt = substr($alt, 0, strlen($alt) - 2);
        }
        else if ($this->endsWith($alt, ' <'))
        {
            $Inline['element']['attributes']['class'] = 'pde-img-left';
            $alt = substr($alt, 0, strlen($alt) - 2);
        }

        $Inline['element']['attributes']['alt'] = $alt;
        $Inline['element']['attributes']['title'] = $alt;
        
        return $Inline;
    }
}
