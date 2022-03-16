<?php
/**
 * MUDE TAMBÉM O ARQUIVO APP\PUBLIC\.HTACCESS
 * RewriteBase /_APP_FOLDER_/public
 */

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
//DB_HOST se for local localhost se for docker o nome do container
define('DB_HOST', '_YOUR_HOST');
define('DB_USER', '_YOUR_USER_');
define('DB_PASS', '_YOUR_PASS_');
define('DB_NAME', '_YOUR_DBNAME');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// valor que está nesta constante /var/www/html/mvc/app

// URL ROOT
define('URLROOT', 'http://' . $_SERVER["SERVER_NAME"] . '_APP_FOLDER_');
//define('URLROOT', 'http://localhost/mvc');

// Site Name
define('SITENAME', '__YOUR_SITE_NAME');

//App Version
define('APPVERSION', '1.0.0');