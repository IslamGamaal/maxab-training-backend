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
