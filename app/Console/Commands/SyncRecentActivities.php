<?php

namespace App\Console\Commands;

use App\Sync\RecentActivityFactory;
use Illuminate\Console\Command;

class SyncRecentActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        app(RecentActivityFactory::class)->make('job-seeker','1C0909C3-286E-4EAA-BB12-79D5758366BE');
//        app(RecentActivityFactory::class)->make('job-seeker','6DD33B9C-B111-49E9-B4D0-F1B38736D9EC');
        app(RecentActivityFactory::class)->make('firm','192695F5-F1BE-431B-8DE7-4302C02AB020');
    }
}
