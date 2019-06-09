<?php


namespace app\engine;


use app\interfaces\IRender;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigRender implements IRender
{
    public function renderTemplate($template, $params = []) {
        $loader = new FilesystemLoader(TWIG_TMPLS);
        $twig = new Environment($loader, [
            //'cache' => TWIG_TMPLS . 'compilation_cache',
        ]);
        $template .= '.twig';
        ob_start();
        echo $twig->render($template, $params);
        return ob_get_clean();
    }
}