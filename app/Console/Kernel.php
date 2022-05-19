<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Task;
use App\Models\User;
use App\Notifications\SlackDateNotification;
use Auth;
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
        #締め切り当日の通知
        $schedule->call(function () {
            $today = Carbon::now()->toDateString();
            $tasks = Task::get();

            foreach ($tasks as $task) {
                $user = User::find($task->user_id);
                //submissionをtoDateStringに変換
                $submission = Carbon::parse($task->submission)->toDateString();
                if ($submission == $today) {
                    Notification::route('slack', $user->slack_url)->notify(new SlackDateNotification($task->title, $task->submission));
                }
            }
        })->everyMinute();
        // ->dailyAt('9:00');

        ##締め切りn日前の通知
        $schedule->call(function () {
            $today = Carbon::now()->toDateString();
            $tasks = Task::get();

            foreach ($tasks as $task) {
                $user = User::find($task->user_id);
                //submissionをtoDateStringに変換
                $submission = Carbon::parse($task->submission)->toDateString();
                $carbon = new Carbon($submission);
                $ad_submission = Carbon::parse($carbon->subday($task->advance))->toDateString();
                if ($ad_submission == $today) {
                    Notification::route('slack', $user->slack_url)->notify(new SlackDateNotification($task->title, $task->submission));
                }
            }
        })->everyMinute();
        // ->dailyAt('9:00');
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
