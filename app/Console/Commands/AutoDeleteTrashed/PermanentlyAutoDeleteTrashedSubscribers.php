<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\BlogManagement\BlogCategories\PermanentlyDeleteTrashedBlogCategoriesAction;
use App\Actions\Admin\Subscribers\PermanentlyDeleteTrashedSubscribersAction;
use App\Models\BlogCategory;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribers:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribers in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedSubscribers = Subscriber::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedSubscribersAction())->handle($trashedSubscribers);

    }
}
