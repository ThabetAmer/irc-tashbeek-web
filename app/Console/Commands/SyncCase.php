<?php

namespace App\Console\Commands;

use App\Sync\CaseFactory;
use Illuminate\Console\Command;

class SyncCase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:case {caseType} : Case Type jobseeker, job-opening, firm, followup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync CommCare cases';

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
        app(CaseFactory::class)->make($this->argument('caseType'));
    }
}
