<?php

namespace app\controllers;

abstract class Controller
{
    private $action;
    protected $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;

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
            return $this->renderTemplate("layouts/{$this->layout}",
                   ['content' => $this->renderTemplate($template, $params)]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);
        $fileName = "../views/{$template}.php";
        if (file_exists($fileName)) {
            include $fileName;
        } else {
            echo "404";
        }
        return ob_get_clean();
    }
}