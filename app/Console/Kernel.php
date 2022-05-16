<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Task;
use App\Models\User;
use App\Notifications\SlackDateNotification;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\SlackNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Console\Commands\TaskNotificationCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            $today = Carbon::now()->toDateString();
            $tasks = Task::get();
            $user = User::find(Auth::id());

            Notification::route('slack', 'https://hooks.slack.com/services/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')->notify(new SlackNotification('hoge'));
            // foreach ($tasks as $task) {
            //     //submissionをtoDateStringに変換
            //     $submission = Carbon::parse($task->submission)->toDateString();
            //     if ($submission == $today) {
            //         Notification::route('slack', $user->slack_url)->notify(new SlackDateNotification($task->title, $task->submission));
            //     }
            // }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected $commands = [
        Commands\TaskNotificationCommand::class,
    ];
}
