<?php

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'super-admin']);
        Role::updateOrCreate(['name' => 'user']);
    }
};
