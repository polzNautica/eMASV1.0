<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        Commands\CleanUpAppointments::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        //$schedule->command('inspire')->hourly();
        $schedule->command('appointments:cleanup')->everyMinute();

        if ($this->app->environment('local')) {
            $schedule->exec('php artisan schedule:run')->everyMinute();
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
