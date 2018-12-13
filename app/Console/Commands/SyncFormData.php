<?php

namespace App\Console\Commands;

use App\Sync\FormDataFactory;
use Illuminate\Console\Command;

class SyncFormData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:form';

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
        try{
            app(FormDataFactory::class)->make();

            $this->info("Form data sync completed.");
        }catch(\Throwable $e){
            $this->error($e->getMessage() . ', Line: ' . $e->getLine() . ', File: '. $e->getFile());
        }
    }
}
