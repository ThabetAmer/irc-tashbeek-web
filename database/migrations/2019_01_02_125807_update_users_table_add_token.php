<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('api_token', 60)->unique()->nullable()->default(null);
        });

        $this->refreshUsersToken();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
    }

    protected function refreshUsersToken()
    {
        try{
            foreach(\App\Models\User::all() as $user){
                $user->api_token = \Illuminate\Support\Str::random(50);
                $user->save();
            }
        }catch(\Throwable $e){
            // Deleted_at is not exists since we added it later.
        }
    }
}
