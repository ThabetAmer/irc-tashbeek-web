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
    protected $signature = 'sync:activities {form}';

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
        $form = $this->argument('form');

        if(!array_key_exists($form, RecentActivityFactory::FORMS)){
            $this->error('{form} must be one of: [' . implode(', ', array_keys(RecentActivityFactory::FORMS)) . '].');
            return ;
        }

        app(RecentActivityFactory::class)->make($form);
    }
}
