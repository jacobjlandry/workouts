<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // reset points every sunday
        $schedule->call(function() {
            foreach(\App\WeeklyPoint::all() as $weeklyPoint) {
                $weeklyPoint->delete();
                \App\WeeklyPoint::create(['user_id' => $weeklyPoint->user_id, 'start' => date("Y-m-d", time()), 'end' => date('Y-m-d', strtotime('Saturday'))]);
            }
        })->sundays();
    }
}
