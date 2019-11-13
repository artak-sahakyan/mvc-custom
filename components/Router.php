<?php

namespace app\components;

use Exception;

class Router
{

    private function getURI()
    {
        if (empty($_SERVER['REQUEST_URI'])) {
            return '';
        }

        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri, '?') !== false) {
            $uri = explode('?', $uri)[0];
        }

        return $uri;
    }

    public function run()
    {
        $uri = $this->getURI();

        $segments = array_filter(explode('/', $uri));

        $name = array_shift($segments);
        if(!$name) {
            $name = 'site';
        }

        $controllerName = $name . 'Controller';
        $controllerName = ucfirst($controllerName);
        if(!$controllerName) {
            $controllerName = 'SiteController';
        }

        $actionName = ucfirst(array_shift($segments));
        if(!$actionName) {
            $actionName = 'Index';
        }
        $actionName = 'action' . $actionName;
        $parameters = $segments;
        $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            throw new Exception('Not found');
        }
        require_once($controllerFile);
        $controllerName = '\app\controllers\\' . $controllerName;
        $controllerObject = new $controllerName($name);

        if(!method_exists($controllerObject, $actionName)) {
            throw new Exception('Not found');
        }

        $result = call_user_func_array([$controllerObject, $actionName], $parameters);
        return $result;
    }
}