<?php


namespace App\Services;


use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersService
{
    protected $usersRepository;
    protected $authService;
    /**
     * UsersService constructor.
     */
    public function __construct()
    {

        $this->usersRepository = new UsersRepository(new User());
        $this->authService = new AuthService();
    }

    public function getAllUsers() {
        return $this->usersRepository->all();
    }

    public function getUserById($id) {
        $user = $this->usersRepository->find($id);
        return $user? $user : response()->json(['error' => 'User does\'t exist'], 404);
    }

    public function getCurrentUserAccessToken() {
        $currentUserId = $this->authService->getCurrentAuthUserId();
        if($currentUserId == -1) return -1;
        return $this->usersRepository->getUserAccessToken($currentUserId);

    }

    public function setCurrentUserAcessToken($token) {
        $currentUserId = $this->authService->getCurrentAuthUserId();
        return $this->usersRepository->setUserAccessToken($currentUserId, $token);

    }

}