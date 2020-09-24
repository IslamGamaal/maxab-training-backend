<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function getCurrentAuthUser() {
        if(!Auth::check()) {
            return response()->json(['error' => 'No logged in user found'], 404);;
        }
        return Auth::user();
    }

    public function getCurrentAuthUserId() {
        if(!Auth::check()) {
            return -1;
        }
        return Auth::user()->id;
    }
}
