<?php
session_start();
require "../config/path.php";
require "../config/auth.php";
require_once VENDOR_DIR . 'autoload.php';
$config = include __DIR__ . "/../config/config.php";

use app\engine\App;

try {
    App::call()->run($config);
} catch (Exception $e) {
    var_dump($e);
}

    