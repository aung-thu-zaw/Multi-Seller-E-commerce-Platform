<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Admin
        $schedule->command('categories:delete')->daily();
        $schedule->command('brands:delete')->daily();
        $schedule->command('blog-categories:delete')->daily();
        $schedule->command('blog-contents:delete')->daily();
        $schedule->command('faq-categories:delete')->daily();
        $schedule->command('faq-subcategories:delete')->daily();
        $schedule->command('faq-contents:delete')->daily();

        // Seller
        $schedule->command('store-product-categories:delete')->daily();
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
