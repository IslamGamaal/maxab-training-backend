<?php


namespace App\Http\Middleware;


use App\Services\UsersService;
use Closure;

class AuthenticateUser
{

    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function handle($request, Closure $next)
    {
        $auth = $request->header('Authorization');

        if (isset($auth) && !is_null($auth)) {
            $token = str_replace("Bearer ", "", $auth);
            if($this->usersService->getCurrentUserAccessToken() != $token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please try to login'
                ], 401);
            }
        }
        return $next($request);
    }
}