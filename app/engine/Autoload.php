<?php


namespace engine;


class Autoload
{
    public function loadClass($className){
        var_dump($className);

        $fileName = '/../' . str_replace('\\', '/', $className);
        var_dump($fileName);
        require $fileName;
        if (file_exists($fileName)) {
            require $fileName;
        }
    }
}