<?php
session_start();
require "../config/path.php";
require "../config/auth.php";
require ENGINE_DIR . "Autoload.php";

use app\engine\{Autoload, Render, TwigRender};
use app\controllers\{Controller, SiteController};

/**
 * @var Controller $controller
 */

require_once VENDOR_DIR . 'autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);

$routeArr = explode('/', $_SERVER['REQUEST_URI']);
$controllerName = $routeArr[1] ?: 'site';
$actionName = $routeArr[2];
$values = array_slice($routeArr, 3);


$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
} else {
    $controller = new SiteController(new Render());
    $actionName = $controllerName;
}
$controller->values = $values;
$controller->runAction($actionName);

    