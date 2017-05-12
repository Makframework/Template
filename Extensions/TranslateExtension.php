<?php

namespace Makframework\Template\Extensions;


class TranslateExtension extends \Twig_Extension
{
    private $dataTranslate = [];

    public function __construct(string $filename)
    {
        $this->dataTranslate = $this->parseFile($filename);
    }

    public function getFilters()
    {
        return [
            'translate' => new \Twig_SimpleFilter('translate', [$this, 'translateFilter'])
        ];
    }


    private function parseFile(string $filename) : array
    {
        if(file_exists($filename)) return parse_ini_file($filename);
        return [];
    }


    public function translateFilter(string $text) : string
    {
        return isset($this->dataTranslate[$text]) ? $this->dataTranslate[$text] : $text;
    }
}