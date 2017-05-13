<?php

namespace Makframework\Template;


use Makframework\Template\Extensions\TranslateExtension;

class Template
{
    private $data = [];

    private $languages = [];

    private $lang = '';

    private $pathTemplates = '';

    /**
     * Template constructor.
     * @param string $pathTemplates
     * @param string $lang
     */
    public function __construct(string $pathTemplates, $lang = 'es')
    {
        $this->pathTemplates = $pathTemplates;
        $this->lang = $lang;
    }

    /**
     * Register languages
     * @param array $languages
     * @return void
     */
    public function registerLanguages(array $languages) : void
    {
        $this->languages += $languages;
    }

    /**
     * Register language
     * @param string $language
     * @param string $filename
     * @return void
     */
    public function registerLanguage(string $language, string $filename) : void
    {
        $this->languages[$language] = $filename;
    }

    /**
     * Set Data
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setData(string $key, $value) : void
    {
        $this->data[$key] = $value;
    }

    /**
     * Render
     * @param string $template
     * @param array $data
     * @return string
     */
    public function render(string $template, $data = []) : string
    {
        $this->data += $data;

        $loader = new \Twig_Loader_Filesystem($this->pathTemplates);
        $twig = new \Twig_Environment($loader);

        $langFile = isset($this->languages[$this->lang]) ? $this->languages[$this->lang] : '';

        $twig->addExtension(new TranslateExtension($langFile));

        return $twig->render($template, $this->data);
    }
}