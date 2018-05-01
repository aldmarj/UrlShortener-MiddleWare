<?php

use Shortly\Models\Link;
use Slim\App;



$app->post('/api/generate', function($req, $res, $args) use ($app) {
    $body = json_decode($req->getBody());
    
    
   if(empty($body) || empty(trim($body->url ))){
        return $res->withStatus(400)->write(json_encode([
            'error' => [
                'handle' => 1000,
                'message' => 'A URL is required.'
            ]
        ]));

    }

        if (!filter_var($body->url, FILTER_VALIDATE_URL)) {
            return $res->withStatus(400)->write(json_encode([
                'error' => [
                    'handle' => 1001,
                    'message' => 'A valid URL is required.'
                ]
            ]));
        }
    
    $link = Link::where('url', $body->url)->first();
   
    if ($link) {
        return $res->withStatus(201)->write(json_encode([
            'url' => $body->url,
            'generated' => [
                'url' => 'http://localhost/Shortly-API/public/code' . '/' . $link->handle,
                'handle'=> $link->handle
            ],
            'already'=> true
        ]));
    }

    $newLink = Link::create([
        'url' => $body->url,
        'handle' => $body->handle,
        'domain' => $body->domain,
        'name' => $body->name
    ]);

    return $res->withStatus(201)->write(json_encode([
        'url' => $body->url,
        'generated' => [
            'url' => 'http://localhost/Shortly-API/public/codee' . '/' . $newLink->handle,
            'handle' => $body->handle,
            'domain' => $body->domain,
            'name' => $body->name
        ]
    ]));
});