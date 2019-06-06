<?php


namespace app\engine;


class Autoload
{
    public function loadClass($className)
    {
        $fileName = str_replace(['app\\', '\\'],[ROOT_DIR, DS], $className) . '.php';
        if (file_exists($fileName)) {
            require_once $fileName;
        }else{
            echo "Файл {$fileName} с классом {$className} не найден!";
        }
    }
}