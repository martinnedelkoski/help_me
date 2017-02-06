<?php

use Illuminate\Database\Seeder;
use App\Roles\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->setName('admin');
        $role->save();

        $role = new Role();
        $role->setName('user');
        $role->save();
    }
}
