<?php


namespace app\engine;


use app\interfaces\IRender;
use \Exception;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigRender implements IRender
{

    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(TWIG_TMPLS);
        $this->twig = new Environment($loader, [
            //'cache' => TWIG_TMPLS . 'compilation_cache',
        ]);
    }

    public function renderTemplate($template, $params = []) {
        try {
            return $this->twig->render($template . ".twig", $params);
        }
        catch (Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}