<?php

namespace Makframework\Template;


use Makframework\Template\Extensions\TranslateExtension;

class Template
{
    private $data = [];

    private $languages = [];

    private $lang = '';

    private $pathTemplates = '';


    public function __construct(string $pathTemplates, $lang = 'es')
    {
        $this->pathTemplates = $pathTemplates;
        $this->lang = $lang;
    }

    public function registerLanguages(array $languages) : void
    {
        $this->languages += $languages;
    }

    public function registerLanguage(string $language, string $filename) : void
    {
        $this->languages[$language] = $filename;
    }

    public function render(string $template, $data = []) : string
    {

        $loader = new \Twig_Loader_Filesystem($this->pathTemplates);
        $twig = new \Twig_Environment($loader);

        $langFile = isset($this->languages[$this->lang]) ? $this->languages[$this->lang] : '';

        $twig->addExtension(new TranslateExtension($langFile));

        return $twig->render($template, $this->data);
    }
}