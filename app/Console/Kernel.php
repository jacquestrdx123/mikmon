<?php

namespace App\Console;

use App\Models\Device;
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
        $schedule->command('PollDevices')->everyMinute()->runInBackground();
        $schedule->command('QueuePingJob')->everyMinute();
        $schedule->command('SyncInterfaces')->everyMinute();
        $schedule->command('QueueHistoricalPingJob')->everyMinute();
        $schedule->command('ResetInterfaces')->daily();
        $schedule->command('QueueUpdateLocationCountersJob')->everyMinute();
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
