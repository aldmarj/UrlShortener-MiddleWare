<?php

use Shortly\Models\Link;
use Shortly\Models\Analytics;

$app->get('/code/{handle}', function($request, $response, $args) use ($app) {

$userip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=86.31.58.7"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
$lon = $geo["geoplugin_longitude"]; 
$lat = $geo["geoplugin_latitude"];

if(isset($_SERVER['HTTP_REFERER'])) {
    $http_referer = $_SERVER['HTTP_REFERER'];
}
else
{
    $http_referer = 'null';
}

$useragent=$_SERVER['HTTP_USER_AGENT'];

$link = Link::where('handle', $args['handle'])->first();
$linkid = $link->id;

echo($linkid);
 if (!$link) {
     $app->notFound();
 }

//  die($link->url);

// $app->response->redirect($link->url);
try {
        $newLink = Analytics::create([
        'ip_address' => $userip,
        'country' => $country,
        'city' => $city,
        'lat' => $lat,
        'lon' => $lon,
        'url_referral' => $http_referer,
        'device_info' => $useragent,
        'link_id' => $linkid
        ]);
 } 
catch (Exception $e){
    dd($e);
}
});