<?php

/**
 * This method is used to get settings of current account.
 */
class SwitchThemes extends Controller
{
    /**
     * This method handles viewing of settings page.
     * @return void
     */
    public function index()
    {
        if (isset($_SESSION['theme']))
        {
            if ($_SESSION['theme'] == 'dark')
            {
                $_SESSION['theme'] = 'light';
            } elseif ($_SESSION['theme'] == 'light')
            {
                $_SESSION['theme'] = 'dark';
            }
        } else
        {
            $_SESSION['theme'] = 'dark';
        }
        $this->view('habitwelcome');
    }
}