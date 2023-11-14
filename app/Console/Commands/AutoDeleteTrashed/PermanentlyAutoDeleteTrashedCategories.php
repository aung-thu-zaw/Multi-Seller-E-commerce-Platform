<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Categories\PermanentlyDeleteTrashedCategoriesAction;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Categories in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle():void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $categories = Category::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedCategoriesAction())->handle($categories);

    }
}
