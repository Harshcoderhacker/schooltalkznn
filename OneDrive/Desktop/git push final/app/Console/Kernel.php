<?php

namespace App\Console;

use App\Console\Commands\Staff\Attendance\StaffattendanceJob;
use App\Console\Commands\Student\Attendance\StudentattendanceJob;
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
        StaffattendanceJob::class,
        StudentattendanceJob::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('student:attendance')->dailyAt('00:01');
        $schedule->command('staff:attendance')->dailyAt('00:10');
        $schedule->command('feedpost:trimvideo')->everyFiveMinutes();
        $schedule->command('student:idealibrary')->hourly();
        $schedule->command('staff:idealibrary')->hourly();
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
