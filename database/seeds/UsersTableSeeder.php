<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mlUser = User::query()
            ->where('email', '=', 'ml@tashbeek.org')
            ->first();

        if (!$mlUser) {
            User::query()->insert([
                'name' => 'ML User',
                'email' => 'ml@tashbeek.org',
                'password' => bcrypt('irc123!')
            ]);
        }

    }
}
