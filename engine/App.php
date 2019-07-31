<?php


namespace app\engine;


use app\traits\Tsingletone;

class App
{
    use Tsingletone;

    /**
     *  Configuration File
     *  return array with
     *
     */

    protected $config;

    /**
     *  Storage for app components
     *
     */

    private $components;

    private $controller;
    private $action;

    public function run($config) {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public static function call() {
        return static::getInstance();
    }

    public function __get($name) {
        return $this->components->get($name);
    }

    public function runController() {
        $this->controller = $this->request->getControllerName() ?: 'user';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'].ucfirst($this->controller)."Controller";

        try {
            if (class_exists("$controllerClass")) {
                $controller = new $controllerClass(new Render());
                $controller->runAction($this->action);
            } else {
                throw new \Exception("Класс не существует", 404);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createComponent($name) {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }

}