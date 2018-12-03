<?php

use Illuminate\Database\Seeder;
use \App\User;
use \App\Job;
use \App\Firm;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Firm::query()
            ->where('id', '=', 1)
            ->forceDelete();


        Job::query()
            ->where('id', '=', 1)
            ->forceDelete();


        $firm = Firm::query()
            ->create([
                'id' => 1,
                'title' => 'Souktel',
                'description' => 'Souktel Digital Solutions company'
            ]);

        Job::query()->create([
            'id' => 1,
            'title' => 'Backend Developer',
            'description' => 'Backend Developer with 10 year experince',
            'openings' => 1,
            'firm_id' => $firm->id,
        ]);
    }
}
