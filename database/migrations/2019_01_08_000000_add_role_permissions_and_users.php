<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\Artisan;

class AddRolePermissionsAndUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app(RolesTableSeeder::class)->run();
        app(PermissionsTableSeeder::class)->run();
        app(RolePermissionTableSeeder::class)->run();
        app(AddUserRolesTableSeeder::class)->run();
    }


}
