<?php

namespace Core;

class View
{
    private $templatePath;
    private $data;
    private $twig;

    public function __construct()
    {

    }

    public function setTemplatePath(string $path): void
    {
        $this->templatePath = $path;
    }

    public function __get($name)
    {

        return $this->data[$name];
    }

    public function render(string $tpl, $data = []): string
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        ob_start();
        include $this->templatePath . '/' . $tpl;

        return ob_get_clean();
    }

    public function renderTwig(string $tpl, $data = [])
    {
        if (!$this->twig) {
            $loader = new \Twig\Loader\FilesystemLoader($this->templatePath);
            $this->twig = new \Twig\Environment($loader);
        }

        return $this->twig->render($tpl, $data);
    }
}