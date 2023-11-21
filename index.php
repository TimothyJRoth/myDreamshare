<?php

require_once __DIR__ . '/vendor/autoload.php';
$factory = new \App\Core\Factory();
$router = new \Bramus\Router\Router();
$apiController = $factory->make('ApiController');

$router->options('/api/.*', function () {
    header("HTTP/1.1 200 OK");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, API-Key");
    exit;
});

$router->get('/', function () use ($apiController) {
    $apiController->documentation();
});

$router->get('/api/wishlist/([0-9a-fA-F-]+)', function ($uuid) use ($apiController) {
    $apiController->getWishlist($uuid);
});

$router->get('/api/wishes/([0-9a-fA-F-]+)', function ($wishlist_uuid) use ($apiController) {
    $apiController->getWishes($wishlist_uuid);
});

$router->post('api/wishlist/add', function () use ($apiController) {
    $apiController->addWishlist();
});

$router->post('api/wish/add', function () use ($apiController) {
    $apiController->addWish();
});

$router->get('/api/wish/delete/([0-9a-fA-F-]+)', function ($id) use ($apiController) {
    $apiController->deleteWish($id);
});

$router->run();