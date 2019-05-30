<?php


namespace engine;


class Autoload
{
    public function loadClass($className)
    {
        $fileName = ROOT_DIR . str_replace('\\', '/', $className) . '.php';
        if (file_exists($fileName)) {
            require_once $fileName;
        }else{
            echo "Файл {$fileName} с классом {$className} не найден!";
        }
    }
}