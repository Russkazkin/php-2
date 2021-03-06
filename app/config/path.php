<?php
define("PUBLIC_DIR", $_SERVER['DOCUMENT_ROOT'] . "/");
define("PUBLIC_HTTP", $_SERVER['HTTP_HOST'] . "/");
define("ROOT_DIR", PUBLIC_DIR . "../");
define("CONFIG_DIR", ROOT_DIR . "config/");
define("ENGINE_DIR", ROOT_DIR . "engine/");
define("UPLOADS_DIR", ROOT_DIR . "uploads/");
define("VENDOR_DIR", ROOT_DIR . "vendor/");
define("TEMPLATES_DIR", ROOT_DIR . "views/");
define("LAYOUTS_DIR", "./layouts/");
define("TWIG_TMPLS", ROOT_DIR . "twig_tmpls/");
define('DS', DIRECTORY_SEPARATOR);
define("CONTROLLER_NAMESPACE", "app\\controllers\\");
