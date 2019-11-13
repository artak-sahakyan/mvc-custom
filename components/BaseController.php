<?php

namespace app\components;

use Exception;

abstract class BaseController
{

    public $layout = 'main';
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getViewFile($view)
    {
        return ROOT."/views/{$this->name}/{$view}.php";
    }

    protected function getViewContent($view, $params)
    {
        $viewPath = $this->getViewFile($view);
        extract($params);
        ob_start();
        if(!file_exists($viewPath)) {
            throw new Exception($viewPath.' View not found');
        }
        require_once $viewPath;
        return ob_get_clean();
    }

    public function getLayoutPath()
    {
        return ROOT."/views/layouts/{$this->layout}.php";
    }

    public function render($view, $params = [])
    {
        $content = $this->getViewContent($view, $params);
        ob_start();
        require_once $this->getLayoutPath();
        return ob_get_clean();
    }

    public function redirect($url)
    {
        header("Location: $url");
        die;
    }


}