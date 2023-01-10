<?php

/**
 * This method is used to get settings of current account.
 */
class Settings extends Controller
{
    /**
     * This method handles viewing of settings page.
     * @return void
     */
    public function index()
    {
        $this->view('habitsettings');
    }
}