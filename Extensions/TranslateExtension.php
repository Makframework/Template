<?php

namespace Makframework\Template\Extensions;


class TranslateExtension extends \Twig_Extension
{
    private $dataTranslate = [];

    /**
     * TranslateExtension constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->dataTranslate = $this->parseFile($filename);
    }

    /**
     * Get filters
     * @return array
     */
    public function getFilters()
    {
        return [
            'translate' => new \Twig_SimpleFilter('translate', [$this, 'translateFilter'])
        ];
    }

    /**
     * Parse file
     * @param string $filename
     * @return array
     */
    private function parseFile(string $filename) : array
    {
        if(file_exists($filename)) return parse_ini_file($filename);
        return [];
    }

    /**
     * Translate filter
     * @param string $text
     * @return string
     */
    public function translateFilter(string $text) : string
    {
        return isset($this->dataTranslate[$text]) ? $this->dataTranslate[$text] : $text;
    }
}