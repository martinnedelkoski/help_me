<?php

namespace App\Users\Repositories;

use App\Users\User;

interface UsersRepositoryInterface
{
    public function store(User $user);

    /**
     * @param int $id
     * @return User
     */
    public function find($id);
}
