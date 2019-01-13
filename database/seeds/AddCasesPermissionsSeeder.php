<?php

use Illuminate\Database\Seeder;

class AddCasesPermissionsSeeder extends Seeder
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
            'cases.match'
        ];

        $this->givePermissionToSuperUser($permissions);

        $this->givePermissionToESO($permissions);
    }
}
