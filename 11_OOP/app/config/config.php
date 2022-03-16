<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//todos os erros deixar só a linha abaixo
//error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

//habilita os erros
ini_set('display_errors', true);


// Quando estiver trabalhando com container do docker-compose
// DB_HOST é o nome do container que está rodando o banco de dados
header('Content-Type: text/html; charset=utf-8');

// DB Params
define('DB_HOST', 'mysql');
define('DB_USER', 'root');
define('DB_PASS', 'rootadm');
define('DB_NAME', 'shareposts');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// valor que está nesta constante /var/www/html/mvc/app

// URL ROOT
define('URLROOT', 'http://' . $_SERVER["SERVER_NAME"] . '/11_OOP');
//define('URLROOT', 'http://localhost/mvc');

// Site Name
define('SITENAME', 'mvc');

//App Version
define('APPVERSION', '1.0.0');