<?php


namespace App\Services;


use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersService
{
    protected $usersRepository;
    /**
     * UsersService constructor.
     */
    public function __construct()
    {
        $this->usersRepository = new UsersRepository(new User());
    }

    public function getAllUsers() {
        return $this->usersRepository->all();
    }

    public function getUserById($id) {
        $user = $this->usersRepository->find($id);
        return $user? $user : response()->json(['error' => 'User does\'t exist'], 404);
    }

}