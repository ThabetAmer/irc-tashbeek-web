<?php

namespace App\Console\Commands;

use App\Sync\StructureFactory;
use Illuminate\Console\Command;

class SyncStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:structure {caseType? : (Optional) Case type: job-seeker, firm, job-opening, job-matching}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync CommCare cases structure';

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
            app(StructureFactory::class)->make($this->argument('caseType'));

            $this->info("Sync [" . $this->argument('caseType') . "] structure completed.");
        }catch(\Throwable $e){
            $this->error($e->getMessage() . ', Line: ' . $e->getLine() . ', File: '. $e->getFile());
        }
    }
}
