<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\Artisan;

class AddRolesPermissionsAndUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', array('--class' => 'RolesTableSeeder'));
        Artisan::call('db:seed', array('--class' => 'PermissionsTableSeeder'));
        Artisan::call('db:seed', array('--class' => 'RolePermissionTableSeeder'));
        Artisan::call('db:seed', array('--class' => 'AddUserRolesTableSeeder'));
    }


}
