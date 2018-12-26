<?php

use Illuminate\Database\Seeder;
use \App\Models\User;

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

        $tashbeekUser = User::query()
            ->where('email', '=', 'admin-tashbeek@souktel.com')
            ->first();

        if (!$tashbeekUser) {
            User::query()->insert([
                'name' => 'Admin User',
                'email' => 'admin-tashbeek@souktel.com',
                'password' => bcrypt('tashbeek123!')
            ]);
        }


    }
}
