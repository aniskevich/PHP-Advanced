<?php

namespace app\controllers;

use app\interfaces\IRender;

abstract class Controller
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

    public function runAction() {
        $this->action = $_GET['a'] ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
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
                       'username' => $username
                   ]);
        } else {
            return $this->renderer->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }
}