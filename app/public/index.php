<?php

require "../engine/Autoload.php";
use engine\Autoload;

spl_autoload_register([new Autoload(), 'loadClass']);

$test = new model\Product();
$test->test();