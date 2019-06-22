<?php

namespace app\controllers;

use app\interfaces\IRender;
use app\model\entities\Cart;
use app\model\repositories\CartRepository;

abstract class Controller {
    private $action;
    protected $defaultAction = 'auth';
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;

    public function __construct(IRender $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null) {
        try {
            $this->action = $action ?: $this->defaultAction;
            $method = "action" . ucfirst($this->action);
            if (method_exists($this, $method)) {
                $this->$method();
            } else {
                throw new \Exception("Такое действие нифига не предусмотрено, творец еще глуп", 404);
            }
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionIndex() {
        echo $this->render('index');
    }

    public function render($template, $params = []) {
        if ($this->useLayout) {
            if (!isset($_SESSION['login']))  {
                $username = null;
            } else {
                $username = $_SESSION['login'];
            }
            return $this->renderer->renderTemplate("layouts/{$this->layout}",
                   [
                       'content' => $this->renderer->renderTemplate($template, $params),
                       'username' => $username,
                       'count' => (new CartRepository(session_id()))->getCountWhere('session_id', session_id())
                   ]);
        } else {
            return $this->renderer->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }
}