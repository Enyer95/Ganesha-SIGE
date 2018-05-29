<?php

namespace GaneshaSIGE\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use BackupManager\Filesystems\Destination;

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
         protected function schedule(Schedule $schedule) {
            $schedule->call(function () {
                $manager = \App::make(\BackupManager\Manager::class);
                $manager->makeBackup()->run('pgsql', [new Destination('backup', 'backup'.\Carbon::now().'.sql')], 'gzip');
            })->everyMinute();
         }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
