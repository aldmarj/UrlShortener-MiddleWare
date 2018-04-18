<?php

use Shortly\Models\Link;

$app->any('/code/{code}', function($request, $response, $args) use ($app) {
 
 $link = Link::where('code', $args['code'])->first();

 if (!$link) {
     $app->notFound();
 }

 die($link->url);

 $app->response->redirect($link->url);
 
});