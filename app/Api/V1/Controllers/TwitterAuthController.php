<?php

namespace App\Api\V1\Controllers;


use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;
use Noweh\TwitterApi\Client;
use Noweh\TwitterApiV2\TwitterApi;

class TwitterAuthController extends BaseController
{
    


    public function getOAuthToken()
    {
        // Consumer Key & Secret   
        $consumerKey = 'P1ovVmKEIW4alt5AGZQmdL7Zx';
        $consumerSecret = '8v7pYz5MG8Iw8ibVHvq88MDOA3tmCZpS6yf2ipFjOMcACA0Vj8';

        // Create TwitterOAuth Client
        $connection = new TwitterOAuth($consumerKey, $consumerSecret);

        // Get Request Token
        $requestToken = $connection->oauth('oauth/request_token', [
            'oauth_callback' => url('/callback')
        ]);

        // Redirect to authorize URL
        $url = $connection->url('oauth/authorize', [
            'oauth_token' => $requestToken['oauth_token']
        ]);

        return redirect($url);
    }
    
    public function handleCallback(Request $request)
    {
        // Ensure the required parameters are present
        $oauthToken = $request->input('oauth_token');
        $oauthVerifier = $request->input('oauth_verifier');

        if (!$oauthToken || !$oauthVerifier) {
            return response()->json(['error' => 'Missing OAuth parameters'], 400);
        }

        // Consumer Key & Secret
        $consumerKey = 'P1ovVmKEIW4alt5AGZQmdL7Zx';
        $consumerSecret = '8v7pYz5MG8Iw8ibVHvq88MDOA3tmCZpS6yf2ipFjOMcACA0Vj8';

        // Create Twitter OAuth Client
        $connection = new TwitterOAuth($consumerKey, $consumerSecret);

        // Get access token using the obtained verifier
        $accessToken = $connection->oauth('oauth/access_token', [
            'oauth_token' => $oauthToken,
            'oauth_verifier' => $oauthVerifier,
        ]);

        // Now you have the access token
        return response()->json($accessToken);
    }

    public function getUserDetails($accessToken) {
        $connection = new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            $accessToken['oauth_token'],
            $accessToken['oauth_token_secret']
        );

    
        // Get user details
        $user = $connection->get('account/verify_credentials');
    
        // Store or use $user as needed
    
        return $user;
    }

    public function redirectToTwitterAuth() 
    {
        $authUrl = $this->getOAuthToken();
        return redirect()->away($authUrl);
    }




}
    
    



    



