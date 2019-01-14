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
            'notes.job-opening'
        ];

        $this->givePermissionToSuperUser($permissions);

        $this->givePermissionToESO($permissions);
    }
}
