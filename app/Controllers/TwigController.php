<?php

namespace app\Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigController{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../app/views');
        $this->twig = new Environment($loader);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function render(string $template, array $data = []): void
    {
        $templateFile = $template . '.twig';

        if (!$this->twig->getLoader()->exists($templateFile)) {
            throw new \Exception("Prompt $templateFile not found");
        }

        echo $this->twig->render($templateFile, $data);
    }
}