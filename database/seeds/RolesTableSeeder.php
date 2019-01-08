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
                'name' => 'System Administrator',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Project Match Admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Employment Service Officer (ESO)',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Employment Senior Service Officer (ESSO)',
                'guard_name' => 'web'
            ],
        ]);


    }

}
