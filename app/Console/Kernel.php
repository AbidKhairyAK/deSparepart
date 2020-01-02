<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\LaporanLabaRugiController as LRC;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // Backups (to Google Drive)
        $schedule->command('backup:clean')->dailyAt('01:30');
        $schedule->command('backup:run --only-db')->dailyAt('01:35');

        // Count Laba Rugi
        $schedule->call(function() { LRC::recountPerbulan(); })->dailyAt('02:00');
        $schedule->call(function() { LRC::recountPertahun(); })->monthlyOn(2, '03:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
