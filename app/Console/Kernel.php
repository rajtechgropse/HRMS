<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // Register commands
    protected $commands = [
        \App\Console\Commands\SendPendingTimesheets::class,
        \App\Console\Commands\UpdateExpiredAllocations::class, 


    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     // Schedule the command to run every minute
    //     // $schedule->command('email:send-pending-timesheets')->everyMinute();
    //     $schedule->command('email:send-pending-timesheets')->weeklyOn(1, '01:00');
    // }
    protected function schedule(Schedule $schedule)
{
    $schedule->command('email:send-pending-timesheets')
             ->weeklyOn(1, '01:00');
    $schedule->command('allocations:update-expired')->daily();

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
