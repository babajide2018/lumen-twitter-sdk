<?php

namespace App\Api\V1\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Atymic\Twitter\Twitter as TwitterSDK;


class WebhookController extends BaseController
{
     /**
     * Handle webhooks to receive responses from the messenger API.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\Post(
     *     path="/webhook",
     *     summary="Handle webhooks",
     *     tags={"Webhooks"},
     *     @OA\Response(
     *         response=200,
     *         description="Webhook handled successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Webhook handled successfully"),
     *         )
     *     ),
     * )
     */
    public function handleWebhook(Request $request)
    {
        // Your controller logic to handle the webhook
        return response()->json(['message' => 'Webhook handled successfully']);
    }
}