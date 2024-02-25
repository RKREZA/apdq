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
        // $schedule->command('inspire')->hourly();


        // Remove password reset tokens in every 15 minutes
        $schedule->command('auth:clear-resets')->everyFifteenMinutes();

        // backup regularly
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('01:30');
        $schedule->command('backup:monitor')->daily()->at('03:00');

        // send email Of last unsent email
        // $schedule->call('Modules\Email\Http\Controllers\EmailController@send_unsent_email')->everyMinute();

        // delete soft deleted data
        $schedule->command('model:prune')->daily()->at('04:00');

        // publish scheduled
        $schedule->command('videos:publish-scheduled')->everyMinute(); // or another frequency
        $schedule->command('lives:publish-scheduled')->everyMinute(); // or another frequency
        $schedule->command('posts:publish-scheduled')->everyMinute(); // or another frequency
        $schedule->command('lives:send-notifications')->everyMinute();


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
