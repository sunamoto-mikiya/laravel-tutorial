<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\SlackNotification;
use Carbon\Carbon;

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
        // $schedule->call(function () {
        //     $date = new Carbon();
        //     $tasks = Task::get();
        //     $user = User::find(Auth::id());


        //     foreach ($tasks as $task) {
        //         $advance_day = $date($task->submission)->subday($task->advance);
        //         if ($task->submission == $date->now()) {
        //             Notification::route('slack', $user->slack_url)->notify(new SlackNotification('hogehoge'));
        //         }
        //     }
        // })->everyMinute();
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
}
