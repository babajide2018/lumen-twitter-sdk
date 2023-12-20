<?php

namespace App\Api\V1\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Atymic\Twitter\Twitter as TwitterSDK;



/**
 * @OA\Info(
 *     title="Communications Microservice - (Twitter channel)",
 *     version="1.0",
 *     description="You need to write a REST API microservice. <br>
    You need use Lumen + Swagger + Twitter SDK <br>
    https://github.com/laravel/lumen.git <br>
    https://github.com/DarkaOnLine/SwaggerLume <br>
    https://github.com/atymic/twitter <br>
    It is necessary to integrate Twitter SDK into our REST API microservice. <br>
    We import one of the SDK to choose from those listed below. <br>
    We implement all the logic as much as possible with the built-in functionality of Lumen",
 *     @OA\Contact(
 *         email="ojobabajide2018@gmail.com",
 *         name="Ojo Babajide Joshua",
 *         url="https://geenius.zyrocs.com"
 *     ),
 *     @OA\License(
 *         name="Your License",
 *         url="https://geenius.zyrocs.com"
 *     )
 * )
 */

class SubscriptionController extends BaseController
{
    /**
 * @OA\Post(
 *     path="/subscribe-to-chatbot",
 *     summary="Subscribe users to a Twitter chatbot",
 *     operationId="subscribeToChatBot",
 *     tags={"Subscription"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="User ID",
 *         @OA\JsonContent(
 *             required={"user_id"},
 *             @OA\Property(property="user_id", type="integer", example=123)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User subscribed to Twitter chatbot",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="User subscribed to Twitter chatbot")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
    public function subscribeToChatBot(Request $request)
    {
        $userId = $request->input('user_id');

        // Your Twitter subscription logic here
        try {
            // Initialize Twitter SDK
            $twitter = new TwitterSDK([
                'key' => env('TWITTER_API_KEY'),
                'secret' => env('TWITTER_API_SECRET'),
                'token' => env('TWITTER_ACCESS_TOKEN'),
                'token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
            ]);

            // Subscribe user to the Twitter chatbot
            $twitter->post('friendships/create', [
                'user_id' => $userId,
                'follow' => true,
            ]);

            return response()->json(['message' => 'User subscribed to Twitter chatbot']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
