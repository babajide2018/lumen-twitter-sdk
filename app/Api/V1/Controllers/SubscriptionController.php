<?php

namespace App\Api\V1\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Atymic\Twitter\Twitter as TwitterSDK;


/**
 * @OA\Info(
 *     title="User Subscription",
 *     version="1.0",
 *     description="Your API description",
 *     @OA\Contact(
 *         email="contact@example.com",
 *         name="Your Name",
 *         url="https://example.com"
 *     ),
 *     @OA\License(
 *         name="Your License",
 *         url="https://example.com/license"
 *     )
 * )
 */
class SubscriptionController extends BaseController
{
    /**
     * Subscribe users to a chat bot.
     *
     * @param  Request  $request
     * @bodyParam  int  $user_id  The ID of the user. Example: 123
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\Post(
     *     path="/subscribe",
     *     summary="Subscribe users to a chat bot",
     *     tags={"Subscriptions"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=123),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User subscribed to chat bot",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User subscribed to chat bot"),
     *         )
     *     ),
     * )
     */
    public function subscribeToChatBot(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        // Check if the user is already subscribed (you might want to adjust this based on your database schema)
        $userIsSubscribed = Subscriber::where('user_id', $request->input('user_id'))->exists();

        if ($userIsSubscribed) {
            return response()->json(['message' => 'User is already subscribed to chat bot']);
        }

        // Save the subscription to the database (assuming you have a "subscribers" table)
        Subscriber::create([
            'user_id' => $request->input('user_id'),
        ]);

        // Your controller logic
        return response()->json(['message' => 'User subscribed to chat bot']);
    }

}
