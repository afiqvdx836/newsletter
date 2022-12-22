<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Newsletter;
use Illuminate\Console\Command;

class DeleteCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete newsletter data';

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
     * @return int
     */
    public function handle()
    {
        // $minutes  = Carbon::now()->subMinutes( 2);
        // $a = Newsletter::onlyTrashed()->where('created_at', '<=', $minutes)->forceDelete();
        Newsletter::onlyTrashed()->forceDelete();

        $this->info('successfully delete newsletter');
       
    }
}
