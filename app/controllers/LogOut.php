<?php

class LogOut extends Controller
{
    public function index()
    {
        unset($_SESSION['id']);

        $this->view('signin');
    }
}