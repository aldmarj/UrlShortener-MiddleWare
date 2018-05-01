<?php

use Shortly\Models\Link;

$app->get('/allurls', function($request, $response, $args) use ($app) {

    $page = ($request->getParam('page', 0) > 0) ? $request->getParam('page') : 1;
    $limit = 2;
    $skip = ($page - 1) * $limit;
    $count = Link::get()->count();
    $post = Link::skip($skip)->take($limit)->get();
    $lastpage = ceil($count / $limit) == 0 ? 1 : ceil($count / $limit);

    $response->write(json_encode( [
        'posts' => $post,
        'pagination'    => [
            'needed'    => $count > $limit,
            'count'     => $count,
            'page'      => $page,
            'lastpage'  => $lastpage,
            'limit'     => $limit,
            'next_page' => $_SERVER['SERVER_NAME'] . '/Shortly-API/public/allurls?page=' . ($page + 1),
            'previous_page' => $_SERVER['SERVER_NAME'] . '/Shortly-API/public/allurls?page=' . ($page - 1),
        ]
    ]));

});