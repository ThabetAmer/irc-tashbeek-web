<?php

use Illuminate\Database\Seeder;

class AddSaveMatchPermissionSeeder extends Seeder
{
    use PermissionsUtility;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'cases.match.save'
        ];

        $this->givePermissionToSuperUser($permissions);

        $this->givePermissionToESO($permissions);
    }
}
