<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";

use app\engine\Autoload;
use app\controllers\{Controller, SiteController};

/**
 * @var Controller $controller
 */

spl_autoload_register([new Autoload(), 'loadClass']);

$routeArr = explode('/', $_SERVER['REQUEST_URI']);
$controllerName = $routeArr[1] ?: 'site';
$actionName = $routeArr[2];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else {
    $controller = new SiteController();
    $controller->runAction($controllerName);
}
/*switch ($page) {
    case 'index.php';
    case 'index';
    case '':
        $page = 'home';
        $title = 'Главная';
        $params = [
            'heading' => 'Главная страница',
        ];
        break;
    case 'debug':
        $page = 'debug';
        $title = 'Тестирование функционала';
        break;
}


echo render($page, $title, $params, $ajax);

function render($page, $title, $params = [], $ajax = false)
{
    if (!$ajax) {
        $content = renderTemplate(LAYOUTS_DIR . 'main', ['content' => renderTemplate($page, $params),
                                                                'title' => $title]);
    } else {
        $content = json_encode($params, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }
    return $content;
}

function renderTemplate($page, $params = [])
{
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $fileName = TEMPLATES_DIR . $page . ".php";
    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die("Такой страницы не существует. 404");
    }
    return ob_get_clean();
}*/