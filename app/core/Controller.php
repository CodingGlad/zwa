<?php

class Controller {
    public function model($model) {
        require_once '../app/models' . $model . '.php';
    }

    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
}