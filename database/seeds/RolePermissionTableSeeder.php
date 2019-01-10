<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systemAdministratorRole = $this->getRole('System Administrator');

        $projectMatchAdmin = $this->getRole('Project Match Admin');

        $eso = $this->getRole('Employment Service Officer (ESO)');

        $esso = $this->getRole('Employment Senior Service Officer (ESSO)');

        $this->assignPermissionsToRole($systemAdministratorRole, [
            'users_management',
            'cases.job-seeker',
            'cases.firm',
            'cases.job-opening',
            'cases.job-opening.match',
            'notes.firm',
            'notes.job-seeker',

        ]);

        $this->assignPermissionsToRole($projectMatchAdmin, ['users_management']);

        $this->assignPermissionsToRole($eso, ['cases.job-opening', 'cases.job-opening.match', 'cases.job-seeker', 'notes.job-seeker']);

        $this->assignPermissionsToRole($esso, ['cases.job-opening', 'cases.firm', 'notes.firm']);
    }


    private function getRole($role)
    {
        return Role::findByName($role, 'web');
    }


    private function assignPermissionsToRole(Role $role, $permissions)
    {
        if (!$role) {
            return;
        }

        $role->givePermissionTo($permissions);
    }
}
