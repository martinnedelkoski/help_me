<?php

namespace App\Roles\Repositories;

use App\Roles\Role;

class EloquentRolesRepository implements RolesRepositoryInterface
{
    public function store(Role $role)
    {
        $role->save();
    }

    public function find($id)
    {
        return Role::where('id', $id)->get()->first();
    }
}
