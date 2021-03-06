<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;

use App\Http\Requests\SignUpRequest;
use App\Services\UsersService;
use App\User;


class AuthController extends Controller
{
    private $usersService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
        $this->middleware('auth:api', ['except' => ['login', 'signup']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }
        $this->usersService->setCurrentUserAcessToken($token);
        return $this->respondWithToken($token);
    }

    public function signup(SignUpRequest $request)
    {
        User::create($request->all());
        return $this->login($request);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }
}