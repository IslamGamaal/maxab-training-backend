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
}
