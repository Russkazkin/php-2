<?php


namespace app\engine;


class Autoload
{
    public function loadClass($className)
    {
        echo $className . "<br>";
        $fileName = str_replace(['app\\', '\\'],[ROOT_DIR, DS], $className) . '.php';
        echo $fileName;
        if (file_exists($fileName)) {
            require_once $fileName;
        }else{
            echo "Файл {$fileName} с классом {$className} не найден!";
        }
    }
}