<?php

class Controller {

    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db = "habitjournal";

    public function model($model) {
        require_once '../app/models' . $model . '.php';
    }

    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
}