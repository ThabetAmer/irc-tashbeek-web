<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

use \Spatie\Permission\Models\Permission;

trait PermissionsUtility
{
    protected function givePermissionToSuperUser($permissions)
    {
        $this->givePermissionsByRoleId(1, $permissions);
    }

    protected function givePermissionToMatchAdmin($permissions)
    {
        $this->givePermissionsByRoleId(2, $permissions);
    }

    protected function givePermissionToESO($permissions)
    {
        $this->givePermissionsByRoleId(3, $permissions);
    }

    protected function givePermissionToESSO($permissions)
    {
        $this->givePermissionsByRoleId(4, $permissions);
    }

    private function givePermissionsToRoles($roles, $permissions)
    {
        $permissions = $this->createPermission($permissions);

        foreach($roles as $role){
            $role->givePermissionTo($permissions);
        }
    }

    private function createPermission($permissions, $guard = 'web')
    {
        if (!is_array($permissions)) {
            $permissions = [];
        }

        $list = collect([]);

        foreach ($permissions as $permission) {
            try {
                $found = Permission::findByName($permission, $guard);
            } catch (\Throwable $e) {
                $found = false;
            }

            if (!$found) {
                $found = Permission::create([
                    'name' => $permission,
                    'guard_name' => $guard,
                ]);
            }

            $list->push($found);
        }

        return $list;
    }

    private function givePermissionsByRoleId($id, $permissions){
        $roles = \Spatie\Permission\Models\Role::where('id',$id)->get();

        $this->givePermissionsToRoles($roles, $permissions);
    }

    protected function removePermission($permissions, $guard = 'web'){
        if(!is_array($permissions)){
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission){
            try{
                $permission = Permission::findByName($permission, $guard);

                $permission->delete();

            }catch(\Throwable $e){
                //
            }
        }

    }
}