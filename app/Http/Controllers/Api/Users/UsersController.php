<?php

namespace App\Http\Controllers\Api\Users;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function revoke(Request $request) {
        DB::table('oauth_access_tokens')
            ->where('user_id', $request->user()->id)
            ->update([
                'revoked' => true
            ]);
        return response()->json('DONE');
    }

    public function authUser() {
        if(!Auth::check()) {
            $user = App\User::find(1);
            Auth::login($user);
        }
        return Auth::user();
    }

    public function userById($id) {
        return \App\User::find($id)? \App\User::find($id) : 404;
    }

    public function allUsers() {
        return \App\User::all();
    }
}
