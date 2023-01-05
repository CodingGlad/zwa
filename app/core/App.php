<?php

class App
{

    protected $controller = 'signin';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        session_start();

        $url = $this->parseUrl();

        //TODO handle session id

        if (isset($_SESSION['id'])) {
            if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php'))
            {
                if ($url[0] == 'signin' || $url[0] == 'signup')
                {
                    $this->controller = 'calendar';
                } else
                {
                    $this->controller = $url[0];
                }
                unset($url[0]);
            }
        } else
        {
            $this->controller = 'signin';
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1]))
        {
            if (($this->controller == 'signin' || $this->controller == 'signup') && isset($_SESSION['id']))
            {
                $this->controller = 'index';
                unset($url[1]);
            }
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url']))
        {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        } else
        {
            return [];
        }
    }
}