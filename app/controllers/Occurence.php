<?php

class Occurence extends Controller
{
    public function index()
    {
        $conn = $this->connectDb();



        $this->view('habitoccurence');
    }

    public function add()
    {
        $this->view('habitoccurence');
    }
}