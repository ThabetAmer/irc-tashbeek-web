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


        $this->assignPermissionToRole($systemAdministratorRole, ['users_management', 'job-seekers', 'firms', 'job-opening-eso', 'job-opening-esso']);
        $this->assignPermissionToRole($projectMatchAdmin, ['users_management']);
        $this->assignPermissionToRole($eso, ['job-seekers', 'job-opening-eso']);
        $this->assignPermissionToRole($esso, ['firms', 'job-opening-esso']);
    }


    private function getRole($role)
    {
        return Role::findByName($role, 'web');
    }


    private function assignPermissionToRole($role, $permissions)
    {
        if (!$role) {
            return;
        }

        $role->givePermissionTo($permissions);
    }
}
