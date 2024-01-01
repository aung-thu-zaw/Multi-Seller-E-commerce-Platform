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
        // $schedule->command('products:delete')->daily();
        $schedule->command('collections:delete')->daily();
        $schedule->command('product-banners:delete')->daily();
        $schedule->command('slider-banners:delete')->daily();
        $schedule->command('campaign-banners:delete')->daily();
        $schedule->command('coupons:delete')->daily();
        $schedule->command('regions:delete')->daily();
        $schedule->command('cities:delete')->daily();
        $schedule->command('townships:delete')->daily();
        $schedule->command('shipping-areas:delete')->daily();
        $schedule->command('shipping-methods:delete')->daily();
        $schedule->command('shipping-rates:delete')->daily();

        $schedule->command('blog-categories:delete')->daily();
        $schedule->command('blog-contents:delete')->daily();
        $schedule->command('faq-categories:delete')->daily();
        $schedule->command('faq-subcategories:delete')->daily();
        $schedule->command('faq-contents:delete')->daily();
        $schedule->command('roles:delete')->daily();
        $schedule->command('users:delete')->daily();
        $schedule->command('automated-filter-words:delete')->daily();
        $schedule->command('subscribers:delete')->daily();
        $schedule->command('stores:delete')->daily();

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
