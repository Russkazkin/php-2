<?php


namespace app\engine;
use app\controllers\SiteController;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingleton;


/**
 * Class App
 * @property Request $request
 * @property Session $session
 * @property Authentication $authentication;
 * @property BasketRepository $basketRepository
 * @property UserRepository $userRepository
 * @property ProductRepository $productRepository
 * @property Db $db
 */


class App
{
    use TSingleton;

    public $config;

    /** @var Storage */
    //хранилище компонентов-объектов
    private $components;


    private $controller;
    private $action;
    private $actionParam;

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->config = $config;

        $this->components = new Storage();
        $this->runController();
    }

    //создание компонента при обращении, возвращает объект для хранилища
    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                //воспользуемся библиотекой ReflectionClass для создания класса
                //просто return new $class нельзя
                // т.к. не будут переданы параметры для конструктора
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);

            }
        }
        return null;
    }

    public function runController()
    {
        $this->controller = $this->request->getControllerName() ?: 'site';
        $this->action = $this->request->getActionName();
        $this->actionParam = $this->request->getActionParam();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRender());
        } else {
            $controller = new SiteController(new TwigRender());
            $this->action = $this->controller;
        }
        $controller->param = $this->actionParam;
        $controller->runAction($this->action);
    }

    //Чтобы обращаться к компонентам как к свойствам, переопределим геттер
    function __get($name)
    {
        return $this->components->get($name);
    }
}
