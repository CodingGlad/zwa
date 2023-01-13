<?php

/**
 * This method is used to get settings of current account.
 */
class SwitchThemes extends Controller
{
    /**
     * This method handles switching themes based on value from DB.
     * @return void
     */
    public function index()
    {
        $conn = $this->connectDb();
        $currentTheme = $this->getThemeFromDB($conn);

        $updateSql = "UPDATE users SET theme = '";

        if ($currentTheme == self::LIGHT_THEME)
        {
            $updateSql .= self::DARK_THEME . "' ";
        } else
        {
            $updateSql .= self::LIGHT_THEME . "' ";
        }

        $updateSql .= "WHERE id = '" . $_SESSION['id'] . "'";

        $conn->query($updateSql);

        $this->viewCorrectPage($conn);
    }

    /**
     * This method shows the correct page after successfully switching themes.
     * @return void
     */
    private function viewCorrectPage(&$conn)
    {
        if ($this->isUserControl($conn))
        {
            $this->view('control/habitwelcome');
        } else
        {
            $this->view('habitwelcome');
        }

        $conn->close();
    }
}