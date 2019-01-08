<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::query()->insert([
            [
                'name' => 'system_admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'project_match_admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'eso',
                'guard_name' => 'web'
            ],
            [
                'name' => 'esso',
                'guard_name' => 'web'
            ],
        ]);

    }

}
