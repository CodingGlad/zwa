<?php

/**
 * LogOut controller handles logging out of a user via url.
 */
class LogOut extends Controller
{
    /**
     * This method is used for logging out of currently signed in user.
     * @return void
     */
    public function index()
    {
        unset($_SESSION['id']);

        $this->view('signin');
    }
}