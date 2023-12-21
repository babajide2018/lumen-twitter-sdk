<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Api\V1\Controllers\SubscriptionController;
use App\Http\Controllers\Controller;
use App\Api\V1\Controllers\ChannelSubscriptionController;
use App\Api\V1\Controllers\ChannelSubscription;
use App\Api\V1\Controllers\TwitterAuthController;


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
$router->post('/subscribe-to-chatbot', '\App\Api\V1\Controllers\ChatbotSubscriptionController@subscribeToChatbot');
$router->post('/send-message', '\App\Api\V1\Controllers\MessageController@sendMessage');
$router->post('/webhook', '\App\Api\V1\Controllers\WebhookController@handleWebhook');

$router->get('/auth/twitter', '\App\Api\V1\Controllers\TwitterAuthController@getOAuthToken');
$router->get('/twitter', '\App\Api\V1\Controllers\TwitterAuthController@getRequestToken');
$router->get('/callback', '\App\Api\V1\Controllers\TwitterAuthController@handleCallback');
$router->get('/twitter-auth', '\App\Api\V1\Controllers\TwitterAuthController@getOAuthToken');
$router->get('/initiate-twitter-auth', '\App\Api\V1\Controllers\TwitterAuthController@redirectToTwitterAuth');




