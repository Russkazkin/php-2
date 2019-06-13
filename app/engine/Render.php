<?php


namespace app\engine;


use app\interfaces\IRender;

class Render implements IRender
{
    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);
        $fileName = TEMPLATES_DIR . $template . ".php";
        if (file_exists($fileName)) {
            include $fileName;
        }
        else
            echo "404";
        return ob_get_clean();
    }
}