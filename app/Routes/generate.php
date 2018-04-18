<?php

use Shortly\Models\Link;
use Slim\App;

$app->post('/api/generate', function($req, $res, $args) use ($app) {
    $body = json_decode($req->getBody());
    
   if(empty($body) || empty(trim($body->url ))){
        return $res->withStatus(400)->write(json_encode([
            'error' => [
                'code' => 1000,
                'message' => 'A URL is required.'
            ]
        ]));

    }

        if (!filter_var($body->url, FILTER_VALIDATE_URL)) {
            return $res->withStatus(400)->write(json_encode([
                'error' => [
                    'code' => 1001,
                    'message' => 'A valid URL is required.'
                ]
            ]));
        }
    
    $link = Link::where('url', $body->url)->first();
   
    if ($link) {
        return $res->withStatus(201)->write(json_encode([
            'url' => $body->url,
            'generated' => [
                'url' => 'http://localhost/Shortly-API/public/code' . '/' . $link->code,
                'code'=> $link->code
            ]
        ]));
    }

    $newLink = Link::create([
        'url' => $body->url
    ]);

    $newLink->update([
        'code' => base_convert($newLink->id, 10, 36)
    ]);

    return $res->withStatus(201)->write(json_encode([
        'url' => $body->url,
        'generated' => [
            'url' => 'http://localhost/Shortly-API/public/code' . '/' . $newLink->code,
            'code'=> $newLink->code
        ]
    ]));
});