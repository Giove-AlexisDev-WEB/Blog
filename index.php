<?php

require_once 'configuration.php';

/**
 * CIBLAGE DU CONTROLLER A UTILISER
 * ------------------------------------
 */
$controllerName = Request::get('controller');


if (!$controllerName) {
    $controllerName = "status";
}

$controllerName = strtolower($controllerName);


$controllerName = ucfirst($controllerName);


$controllerName = $controllerName . "Controller";


$chemin = "libraries/controllers/$controllerName.php";
if (!file_exists($chemin)) {

    Http::redirect('index.php');
}

require_once $chemin;

$controller = new $controllerName();

$task = Request::get('task');


if (!$task) {

    $task = "index";
}


if (!method_exists($controller, $task)) {
    Http::redirect("index.php");
}


$controller->$task();
