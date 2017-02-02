<?php

namespace App\Roles\Repositories;

use App\Roles\Role;

interface RolesRepositoryInterface
{
    public function store(Role $role);

    /**
     * @return Role
     */
    public function find($id);
}
