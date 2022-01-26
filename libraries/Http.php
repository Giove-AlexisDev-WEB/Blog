<?php

class Http
{

    /**
     * Redirection utilisateur vers URL
     * 
     * @param string $url
     * @return void
     */

    public static function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }

    /**
     * Permet de rediriger vers la page précédente
     *
     * @return void
     */
    public static function redirectBack()
    {
        self::redirect($_SERVER['HTTP_REFERER']);
    }
}
