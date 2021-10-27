<?php

namespace App\Http\Services\User;

use App\Models\User;

class UserService
{

    public function findAll()
    {
        return User::with('roles')->paginate(10);
    }

}
