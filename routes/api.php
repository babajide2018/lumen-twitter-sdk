<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Api\V1\Controllers\SubscriptionController;
use App\Http\Controllers\Controller;
use App\Api\V1\Controllers\ChannelSubscriptionController;
use App\Api\V1\Controllers\ChannelSubscription;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/swagger-ui', function () {
    return response()
        ->file(base_path('public'));
});




$router->post('/subscribe-to-channel', '\App\Api\V1\Controllers\ChannelSubscriptionController@subscribeToChannel');

