<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use engine\Autoload;

spl_autoload_register([new Autoload(), 'loadClass']);

$test = new model\Product();
$test->test();

// $test2 = new model\Price;