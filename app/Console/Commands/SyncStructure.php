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
    protected $signature = 'sync:structure {case? : (Optional) Case type [jobseeker|firm|job-opening|followups]}';

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
        $case = $this->argument('case');

        app(StructureFactory::class)->make($case);
    }
}
