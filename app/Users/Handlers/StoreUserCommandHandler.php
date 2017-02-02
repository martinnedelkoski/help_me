<?php

namespace App\Users\Handlers;

use App\Users\Commands\StoreUserCommand;
use App\Users\Repositories\UsersRepositoryInterface;
use App\Users\User;
use Carbon\Carbon;
use Illuminate\Contracts\Hashing\Hasher;

class StoreUserCommandHandler
{
    private $users;
    private $hasher;

    public function __construct(UsersRepositoryInterface $users, Hasher $hasher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
    }

    public function handle(StoreUserCommand $command)
    {
        $user = new User();

        $user->setName($command->getName());
        $user->setSurname($command->getSurname());
        $user->setUsername($command->getUsername());
        $user->setEmail($command->getEmail());
        $user->setPassword($this->hasher->make($command->getPassword()));
        $user->setBirthday(new Carbon($command->getBirthday()));

        $this->users->store($user);
    }
}
