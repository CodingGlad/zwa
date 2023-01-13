<?php

/**
 * App class handles usage of correct and existing controller, method and passing its parameters.
 */
class App
{
    const DEFAULT_SIGNED_IN_CONTROLLER = 'Calendar';
    const DEFAULT_NOT_SIGNED_IN_CONTROLLER = 'SignIn';
    const DEFAULT_CONTROL_INDEX_METHOD = 'indexControl';
    const DEFAULT_METHOD = 'index';
    const DEFAULT_CONTROL_CONTROLLER = 'Calendar';
    const DEFAULT_CONTROL_METHOD = 'show';
    protected $controller = 'SignIn';
    protected $method = 'index';
    protected $params = [];
    private $servername = "localhost";
    private $username = "wodecjak";
    private $password = "webove aplikace";
    private $db = "wodecjak";

    /**
     * This is a constructor of App class that handles the selection of controller, method and passing their parameters.
     */
    public function __construct()
    {
        session_start();

        $url = $this->parseUrl();

        $this->chooseValidController($url);

        require_once '/home/wodecjak/www/app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        $this->chooseValidMethod($url);

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**This  is used for parsing url parameters that are used by __construct.
     * @return array|false|string[] array of parameters passed by url.
     */
    private function parseUrl()
    {
        if (isset($_GET['url']))
        {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        } else
        {
            return [];
        }
    }

    /**This method is used for validation of a user that was already signed in before.
     * @param $id string of signed user.
     * @return bool|void true if id is valid, otherwise false.
     */
    private function isIdValid($id)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        $idCheckSql = "SELECT * FROM users WHERE id = '" . $id . "'";

        $result = $conn->query($idCheckSql);
        $conn->close();

        if ($result->num_rows == 1)
        {
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * This function handles the process of choosing correct controller based on provided information.
     * @param $url array for accessing desired controller.
     * @return void
     */
    private function chooseValidController(&$url)
    {
        if (isset($_SESSION['id']) && $this->isIdValid($_SESSION['id']))
        {
            if ($this->isUserControl())
            {
                $this->controlUserController($url);
            } else
            {
                $this->signedInUserController($url);
            }
        } else
        {
            $this->unknownUserController($url);
        }
    }

    /**
     * This function sets valid controller for already signed-in users.
     * @param $url array for accessing desired controller.
     * @return void
     */
    private function signedInUserController(&$url)
    {
        if (isset($url[0]) && file_exists('/home/wodecjak/www/app/controllers/' . $url[0] . '.php'))
        {
            if ($url[0] == 'SingIn' || $url[0] == 'SignUp')
            {
                $this->controller = self::DEFAULT_SIGNED_IN_CONTROLLER;
            } else
            {
                $this->controller = $url[0];
            }
            unset($url[0]);
        } else if (count($url) == 0)
        {
            $this->controller = self::DEFAULT_SIGNED_IN_CONTROLLER;
        }
    }

    /**
     * This function sets valid controller unknown/not signed-in user.
     * @param $url array for accessing desired controller.
     * @return void
     */
    private function unknownUserController(&$url)
    {
        if (isset($url[0]) && ($url[0] == 'SignIn' || $url[0] == 'SignUp'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        } else
        {
            $this->controller = self::DEFAULT_NOT_SIGNED_IN_CONTROLLER;
        }
    }

    /**
     * This function sets valid controller for already signed-in users.
     * @param $url array for accessing method desired method.
     * @return void
     */
    private function chooseValidMethod(&$url)
    {
        if ($this->isUserControl())
        {
            $this->chooseValidControlMethod($url);
        } else
        {
            if (isset($url[1]) && method_exists($this->controller, $url[1]))
            {
                if (($this->controller == 'SignIn' || $this->controller == 'SignUp') &&
                    (isset($_SESSION['id']) && $this->isIdValid($_SESSION['id'])))
                {
                    $this->method = self::DEFAULT_METHOD;
                } else
                {
                    $this->method = $url[1];
                }
                unset($url[1]);
            }
        }
    }

    private function chooseValidControlMethod(&$url)
    {
        if (method_exists($this->controller, self::DEFAULT_CONTROL_METHOD))
        {
            $this->method = self::DEFAULT_CONTROL_METHOD;
        } elseif (method_exists($this->controller, self::DEFAULT_CONTROL_INDEX_METHOD))
        {
            $this->method = self::DEFAULT_CONTROL_INDEX_METHOD;
        } else
        {
            $this->method = self::DEFAULT_METHOD;
        }
        unset($url[1]);
    }

    /**
     * This method checks whether user is a control user across App class.
     * @return bool|void true if user is control, otherwise false.
     */
    private function isUserControl()
    {
        if (isset($_SESSION['id']) && $this->isIdValid($_SESSION['id']))
        {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
            if ($conn->connect_error)
            {
                die();
            }
            $controlSql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "' AND permission = 'contr'";
            $result = $conn->query($controlSql);

            return $result->num_rows == 1;
        } else
        {
            return false;
        }

    }

    /**
     * This function sets valid controller for control users.
     * @param $url array for accessing method desired controller.
     * @return void
     */
    private function controlUserController(&$url)
    {
        if (isset($url[0]) && file_exists('/home/wodecjak/www/app/controllers/' . $url[0] . '.php'))
        {
            if (($url[0] == 'LogOut' || $url[0] == 'SwitchThemes'))
            {
                $this->controller = $url[0];
            } else
            {
                $this->controller = self::DEFAULT_CONTROL_CONTROLLER;
            }
            unset($url[0]);
        }
    }
}