<?php


namespace app\controllers;


use app\engine\App;
use app\interfaces\IRender;
use app\models\repositories\BasketRepository;
use \Exception;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    public $param;
    public $title = 'Undefined title';
    public $userName;
    private $renderer;
    public $request;
    protected $session;
    protected $authentication;
    protected $user_id;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRender $renderer)
    {
        $this->renderer = $renderer;
        $this->authentication = App::call()->authentication;
        $this->session = App::call()->session;
        $this->user_id = $this->authentication->getUserId();
        $this->userName = $this->authentication->getUserName();
        $this->request = App::call()->request;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new Exception('Page not found', 404);
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate(
                "layouts/{$this->layout}",
                [
                    'content' => $this->renderTemplate($template, $params),
                    'title' => $this->title,
                    'userName' => $this->userName,
                    'basketCount' => (new BasketRepository())->getBasketCount(session_id(), $this->user_id)
                ]
            );
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }
}