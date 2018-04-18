<?php
require '../vendor/autoload.php';

use Slim\App;

ini_set('display_errors','On');

$app = new Slim\App;

$app->config([
    'baseUrl'=> 'http://localhost/Shortly-API/public'
]);

 require 'database.php';
 require 'routes.php';