<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Ray\Facades\Ray;
use Illuminate\Support\Facades\Log;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
{
    try {
        $user = Socialite::driver('github')
                 ->stateless()
                 ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                 ->user();
        
        // Fetch the access token
        $accessToken = $user->token;
        
        $findUser = User::where('github_id', $user->id)->first();
        
        if ($findUser) {
            Auth::login($findUser);
            return redirect()->intended('home')->with('accessToken', $accessToken);
        } else {
            $newUser = User::updateOrCreate(['email' => $user->email], [
                'name' => $user->name,
                'github_id' => $user->id,
                'password' => encrypt('123456dummy')
            ]);
            
            Auth::login($newUser);
            return redirect()->intended('home')->with('accessToken', $accessToken);
        }
    } catch (Exception $e) {
        dd($e->getMessage());
    }
}
}
