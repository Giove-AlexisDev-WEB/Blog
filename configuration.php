<?php

session_start();

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_NAME = "blog";

require_once 'libraries/Database.php';
require_once 'libraries/Request.php';
require_once 'libraries/Http.php';
