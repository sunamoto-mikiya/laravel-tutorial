<?php

namespace App\Console\Commands;

use App\Console\Kernel;
use Illuminate\Console\Command;

class TaskNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TaskNotificationCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Slack Message';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        logger('test');
    }
}
