<?php

namespace App\Roles\Handlers;

use App\Roles\Commands\StoreRoleCommand;
use App\Roles\Repositories\RolesRepositoryInterface;
use App\Roles\Role;

class StoreRoleCommandHandler
{
    private $roles;

    public function __construct(RolesRepositoryInterface $roles)
    {
        $this->roles = $roles;
    }

    public function handle(StoreRoleCommand $command)
    {
        $role = new Role();

        $role->setName($command->getName());

        $this->roles->store($role);
    }
}
