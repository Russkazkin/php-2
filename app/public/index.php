<?php
session_start();
require "../config/path.php";
require "../config/auth.php";
require ENGINE_DIR . "Autoload.php";

use app\engine\{Autoload, Render, TwigRender, Authentication};
use app\controllers\{Controller, SiteController};

/**
 * @var Controller $controller
 * @var Authentication $auth
 */


// var_dump($_COOKIE);
require_once VENDOR_DIR . 'autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);


$routeArr = explode('/', $_SERVER['REQUEST_URI']);
$controllerName = $routeArr[1] ?: 'site';
$actionName = $routeArr[2];
$values = array_slice($routeArr, 3);


$auth = Authentication::getInstance();

// $auth->cookieAuth();

if( $actionName != 'login' && !$auth->isLoggedIn()){
    header('Location: /user/login');
}



$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
} else {
    $controller = new SiteController(new TwigRender());
    $actionName = $controllerName;
}
$controller->values = $values;
$controller->runAction($actionName);


    