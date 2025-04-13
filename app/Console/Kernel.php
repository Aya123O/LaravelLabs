<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Log;



class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Run daily at midnight
        $schedule->job(new PruneOldPostsJob)
                ->dailyAt('00:00')
                ->timezone('UTC') 
                
                ->withoutOverlapping(); // prevent duplicate runs
    }

   
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
    
}