<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends Repository
{

    /**
     * AdminRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getUsersCount() {
        return User::all()->count();
    }

    public function getUsersCurrentPage($limit) {
        return User::paginate($limit);
    }

    public function searchUsers($limit, $query) {
        return User::where('name', 'ilike', "%{$query}%")
                ->orWhere('lastName', 'ilike', "%{$query}%")
                ->orWhere('email', '=',"$query")
                ->orWhere('phoneNumber', '=', "$query")
                ->paginate($limit);
    }

    public function getUserAccessToken($id) {
        return User::query()
                ->select('remember_token')
                ->where('id', $id)
                ->first()->remember_token;
    }

    public function setUserAccessToken($id, $token) {
        return User::query()
            ->where('id', $id)
            ->update(['remember_token' => $token]);
    }
}
