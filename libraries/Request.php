<?php

class Request
{
    /**
     * Constante qui représente FILTER_VALIDATE_EMAIL
     */
    const EMAIL = FILTER_VALIDATE_EMAIL;

    /**
     * Constante qui représente FILTER_VALIDATE_INT
     */
    const INT = FILTER_VALIDATE_INT;

    /**
     * Constante qui représente FILTER_SANITIZE_SPECIAL_CHARS
     */
    const SAFE = FILTER_SANITIZE_SPECIAL_CHARS;

    /**
     * Permet de récupérer une information dans la requête (POST ou GET) en donnant la priorité au POST
     *
     * @param string $name
     * @param integer $filter
     * @return void
     */
    public static function get(string $name, int $filter = FILTER_DEFAULT)
    {
        // extraction à partir du POST
        $value = filter_input(INPUT_POST, $name, $filter);

        // Si on ne trouve POST on essaye avec le GET
        if (!$value) {
            $value = filter_input(INPUT_GET, $name, $filter);
        }

        // On retourne la valeur
        return $value;
    }

    /**
     * Permet de rediriger vers $url si aucune info n'est dans le POST
     *
     * @param string $url
     * @return void
     */
    public static function redirectIfNotSubmitted(string $url)
    {
        if (empty($_POST)) {
            Http::redirect($url);
        }
    }
}
