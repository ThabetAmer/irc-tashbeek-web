<?php

namespace App\Console\Commands;

use App\Sync\DataFactory;
use Illuminate\Console\Command;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:data {caseType} : Case Type job-seeker, job-opening, firm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync CommCare cases data';

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
        try{
            app(DataFactory::class)->make($this->argument('caseType'));

            $this->info("Sync " . $this->argument('caseType') . ' data completed.');
        }catch(\Throwable $e){
            $this->error($e->getMessage() . ', Line: ' . $e->getLine() . ', File: '. $e->getFile());
        }
    }
}
