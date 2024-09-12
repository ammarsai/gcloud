<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Ray\Facades\Ray;
use Illuminate\Support\Facades\Log;

class KeycloakController extends Controller
{
    public function redirectToKeycloak()
    {
        //return Socialite::driver('keycloak')->redirect();
        return Socialite::driver('keycloak')
        ->scopes(['openid', 'profile', 'email', 'phone'])
        ->redirect();
    }

    public function handleKeycloakCallback()
{
    try {
        $user = Socialite::driver('keycloak')
            ->stateless()
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->user();

        // Fetch the access token
        $accessToken = $user->token;
        $keycloakData = $user->user;
        //$phoneNumber = $keycloakData['phone_number'] ?? 'Phone number not available';
        //$addressData = $user->get('address'); // assuming 'address' is a valid attribute in Keycloak


        // Print out all the data to check if phone is included
        //print_r($keycloakData);
        

        // Check if the phone number is present
        //$phoneNumber = $keycloakData['phone_number'] ?? 'Phone number not available';
        //echo $phoneNumber; // Debugging the phone number

        // Pass the data to the view
        return view('keycloak', compact('keycloakData'));
        //return view('keycloak', compact('keycloakData', 'phoneNumber'));
        //return view('keycloak', compact('keycloakData', 'addressData'));

    } catch (Exception $e) {
        return redirect('/')->with('error', 'Error fetching Keycloak data');
    }
}

    }
