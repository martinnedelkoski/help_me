<?php

use Illuminate\Database\Seeder;
use App\Users\User;
use App\Roles\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();

        $admin->setName('Admin');
        $admin->setSurname('Admin');
        $admin->setUsername('admin');
        $admin->setEmail('admin@help.me');
        $admin->setBirthday(new \Carbon\Carbon('01-01-1980'));
        $admin->setPassword('123456');

        $role = Role::where('name', 'admin')->get()->first();

        $admin->setRole($role);

        $admin->save();
    }
}
