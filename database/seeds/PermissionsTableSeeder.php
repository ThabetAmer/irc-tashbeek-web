<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::query()
            ->insert([
                [
                    'name' => 'users_management',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'job-seekers',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'firms',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'job-opening-eso', // ESOs find job seeker “matches” for job openings available at firms
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'job-opening-esso', // Filling job-opening,
                    'guard_name' => 'web',
                ]
            ]);

    }

}
