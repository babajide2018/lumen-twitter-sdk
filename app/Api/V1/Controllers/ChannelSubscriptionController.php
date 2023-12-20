<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ChannelSubscriptionController extends BaseController
{
     /**
     * Subscribe users to a channel or chat.
     *
     * @param  Request  $request
     * @bodyParam  int  $user_id  The ID of the user. Example: 123
     * @bodyParam  string  $channel_name  The name of the channel. Example: "general"
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\Post(
     *     path="/subscribe-to-channel",
     *     summary="Subscribe users to a channel or chat",
     *     tags={"Channel Subscriptions"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=123),
     *             @OA\Property(property="channel_name", type="string", example="general"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User subscribed to channel",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User subscribed to channel"),
     *         )
     *     ),
     * )
     */
    public function subscribeToChannel(Request $request)
    {
        // Your controller logic
        return response()->json(['message' => 'User subscribed to channel']);
    }

}
