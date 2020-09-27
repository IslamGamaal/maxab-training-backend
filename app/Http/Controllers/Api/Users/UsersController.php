<?php

namespace App\Http\Controllers\Api\Users;
use App\Http\Controllers\Controller;

use App\Services\AuthService;
use App\Services\UsersService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    private $usersService;
    private $authService;

    public function __construct()
    {
        $this->usersService = new UsersService();
        $this->authService = new AuthService();
    }

    public function authUser() {
        return $this->authService->getCurrentAuthUser();
    }

    public function usersCount() {
        return $this->usersService->getUsersCount();
    }

    public function userById($id) {
        return $this->usersService->getUserById($id);
    }

    public function allUsers() {
        return $this->usersService->getAllUsers();
    }

    public function allUsersByPage($limit) {
        return $this->usersService->getUsersByPage($limit);
    }

    public function searchUsers($limit, $query) {
        return $this->usersService->searchUsers($limit, $query);
    }
}
