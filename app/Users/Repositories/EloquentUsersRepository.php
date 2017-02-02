<?php

namespace App\Users\Repositories;

use App\Users\User;

class EloquentUsersRepository implements UsersRepositoryInterface
{
    public function store(User $user)
    {
        $user->save();
    }

    public function find($id)
    {
        return User::where('id', $id)->get()->first();
    }
}
