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
                    'name' => $this->getCaseTypePermission('cases', \App\Models\JobSeeker::class),
                    'guard_name' => 'web',
                ],
                [
                    'name' => $this->getCaseTypePermission('cases', \App\Models\Firm::class),
                    'guard_name' => 'web',
                ],
                [
                    'name' => $this->getCaseTypePermission('cases', \App\Models\JobOpening::class),
                    'guard_name' => 'web',
                ],
                [
                    'name' => $this->getCaseTypePermission('cases', \App\Models\JobOpening::class, 'match'),
                    'guard_name' => 'web',
                ],
                [
                    'name' => $this->getCaseTypePermission('notes', \App\Models\Firm::class),
                    'guard_name' => 'web',
                ],
                [
                    'name' => $this->getCaseTypePermission('notes', \App\Models\JobSeeker::class),
                    'guard_name' => 'web',
                ]

            ]);

    }


    private function getCaseTypePermission($permission, $model, $action = null)
    {
        $caseType = case_type($model);
        $result = "$permission.$caseType";
        if ($action) {
            $result .= ".$action";
        }
        return $result;
    }

}
