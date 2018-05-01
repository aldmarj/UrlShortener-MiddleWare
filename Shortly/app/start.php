<?php
require '../vendor/autoload.php';

use Slim\App;

ini_set('display_errors','On');

$app = new Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->config([
    'baseUrl'=> 'http://localhost/Shortly-API/public'
]);

 require 'database.php';
 require 'routes.php';