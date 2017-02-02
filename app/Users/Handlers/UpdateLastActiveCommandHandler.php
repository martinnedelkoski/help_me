<?php

namespace App\Users\Handlers;

use App\Users\Commands\UpdateLastActiveCommand;
use App\Users\Repositories\UsersRepositoryInterface;
use Carbon\Carbon;

class UpdateLastActiveCommandHandler
{
    private $users;

    public function __construct(UsersRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function handler(UpdateLastActiveCommand $command)
    {
        $user = $this->users->find($command->getUserId());

        $user->setLastOnline(Carbon::now());

        $this->users->store($user);
    }
}
