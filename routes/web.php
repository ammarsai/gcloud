<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\KeycloakController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(GithubController::class)->group(function(){
    Route::get('auth/github', 'redirectToGithub')->name('auth.github');
    Route::get('auth/github/callback', 'handleGithubCallback');
});




//Route::get('auth/keycloak', [KeycloakController::class, 'redirectToKeycloak'])->name('auth.keycloak');
//Route::get('auth/keycloak/callback', [KeycloakController::class, 'handleKeycloakCallback']);

Route::get('login/keycloak/', [KeycloakController::class, 'redirectToKeycloak'])->name('login.keycloak');
Route::get('login/keycloak/callback', [KeycloakController::class, 'handleKeycloakCallback'])->name('login.keycloak.callback');


//Route::get('login/keycloak', 'LoginController@redirectToKeycloak')->name('login.keycloak');
//Route::get('login/keycloak/callback', 'LoginController@handleKeycloakCallback');

// routes/web.php



//Route::get('/login/keycloak', [KeycloakController::class, 'redirectToKeycloak']);
//Route::get('/login/keycloak/callback', [KeycloakController::class, 'handleCallback']);