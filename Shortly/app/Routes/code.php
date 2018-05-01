<?php

use Shortly\Models\Link;

$app->get('/code/{handle}', function($request, $response, $args) use ($app) {
 
 $link = Link::where('handle', $args['handle'])->first();

 if (!$link) {
     $app->notFound();
 }

 die($link->url);

 $app->response->redirect($link->url);
 
});