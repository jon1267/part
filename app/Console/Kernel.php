<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\PassivePartner;

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
        ////запуск письма на кучу (~389) пользователей ... как отработает хз ... закомментировал
        ////$schedule->command(PassivePartner::class)->daily();
        //// запуск лариного Щедулера - php artisan schedule:run (однократно, для тестов но тогда не ->daily() а ->dailyAt(13:00))
        //// запуск лариного Щедулера для постоянного юзанья - php artisan schedule:work ... но если что как его снимать ???
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
