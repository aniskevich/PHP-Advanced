<?php

namespace app\controllers;

use app\interfaces\IRender;
use app\engine\App;

abstract class Controller implements IRender
{
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
            if (is_null(App::call()->session->getLogin()))  {
                $username = null;
            } else {
                $username = App::call()->session->getLogin();
            }
            if (!App::call()->session->isAdmin()) {
                $admin = false;
            } else {
                $admin = true;
            }
            return $this->renderer->renderTemplate("layouts/{$this->layout}",
                   [
                       'content' => $this->renderer->renderTemplate($template, $params),
                       'username' => $username,
                       'admin' => $admin,
                       'count' => $count = App::call()->session->getCount()
                   ]);
        } else {
            return $this->renderer->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }
}