<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UsersSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync CommCare users to database.';

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

            app(\App\Sync\UsersSync::class)->make();

            $this->info("Sync commcare users has been completed.");
        }catch(\Throwable $e){
            $this->error($e->getMessage() . ', Line: ' . $e->getLine() . ', File: '. $e->getFile());
        }
    }
}
