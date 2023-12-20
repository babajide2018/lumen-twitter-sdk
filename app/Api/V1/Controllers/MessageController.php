<?php


namespace App\Api\V1\Controllers;


use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Atymic\Twitter\Twitter as TwitterSDK;


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
     *     path="/send-message",
     *     summary="Send messages to subscribers",
     *     tags={"Messages"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=123),
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
    public function sendMessage(Request $request)
    {
        // Your controller logic
        return response()->json(['message' => 'Message sent to subscribers']);
    }
}
