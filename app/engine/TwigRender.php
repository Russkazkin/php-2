<?php


namespace app\engine;


use app\interfaces\IRender;

class TwigRender implements IRender
{
    public function renderTemplate($template, $params = []) {
        //подключить твиг

        // echo $twig->render('index.html', $params);
    }
}