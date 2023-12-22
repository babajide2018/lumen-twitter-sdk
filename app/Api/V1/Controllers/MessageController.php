<?php


namespace App\Api\V1\Controllers;


use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Subscriber;
use Atymic\Twitter\Twitter as TwitterSDK;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;


class MessageController extends BaseController
{
    /**
     * Send messages to subscribers.
     *
     * @param  Request  $request
     * @bodyParam  int  $user_id  The ID of the user. Example: 123
     * @bodyParam  string  $message  The message to send. Example: "Hello, subscribers!"
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\Post(
     *     path="/send-direct-message",
     *     summary="Send messages to subscribers",
     *     tags={"Messages"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Hello, subscribers!"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Message sent to subscribers",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Message sent to subscribers"),
     *         )
     *     ),
     * )
     */

     public function sendDirectMessageToSubscribers(Request $request)
{
    // Your Twitter API credentials
    $consumerKey = 'P1ovVmKEIW4alt5AGZQmdL7Zx';
    $consumerSecret = '8v7pYz5MG8Iw8ibVHvq88MDOA3tmCZpS6yf2ipFjOMcACA0Vj8';
    $access_token = '1735594427932884992-ghmuZ57SWLAlNQNBmHtdDYKNv5xQ8L';
    $access_token_secret = 'b477x7NpBOpCi1RZ72VhZa5b85AYIHouInq306DSflbYv';

    // Fetch user IDs from the subscribers table
    $userIds = Subscriber::pluck('user_id')->toArray();

    // Initialize Twitter API client
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token, $access_token_secret);

    // Message text from the request
    $messageText = $request->input('message');

    // Loop through each user ID and send a direct message
    foreach ($userIds as $userId) {
        $data = [
            'event' => [
                'type' => 'message_create',
                'message_create' => [
                    'target' => [
                        'recipient_id' => $userId,
                    ],
                    'message_data' => [
                        'text' => $messageText,
                    ],
                ],
            ],
        ];

        // Send the direct message
        $result = $connection->post('direct_messages/events/new', $data, true); // Note the true

        // Check for errors in the API response
        if (isset($result->errors)) {
            // Log the errors for debugging
            Log::error('Twitter API Error:', ['errors' => $result->errors]);
        }
    }

    return response()->json(['success' => 'Message sent to all subscribers successfully']);
}
}
