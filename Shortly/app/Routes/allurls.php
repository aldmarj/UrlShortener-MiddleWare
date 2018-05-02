<?php

use Shortly\Models\Link;

$app->get('/allurls', function($request, $response, $args) use ($app) {

    $page = ($request->getParam('page', 1) > 0) ? $request->getParam('page') : 1;
    $limit = $request->getParam('limit', 10);
    $count = Link::get()->count();
    // $limit = 2;
    $lastpage = ceil($count / $limit) == 0 ? 1 : ceil($count / $limit);
    $page = $page > $lastpage ? 1 : $page; 
   
    $skip = ($page - 1) * $limit;
    
    $result = Link::skip($skip)->take($limit)->get();
    $response->write(json_encode( [
        'results' => $result,
        'pagination'    => [
            'needed'    => $count > $limit,
            'count'     => $count,
            'page'      => $page,
            'lastpage'  => $lastpage,
            'limit'     => $limit,
            'next_page' => $page + 1 <= $lastpage ? $_SERVER['SERVER_NAME'] . '/Shortly-API/public/allurls?page='.($page+1)  : null,
            'previous_page' => $page - 1 >= 1 ? $_SERVER['SERVER_NAME'] . '/Shortly-API/public/allurls?page=' . ($page - 1) : null,
        ]
    ]));

});