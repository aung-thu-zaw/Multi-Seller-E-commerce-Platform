<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\BlogManagement\BlogCategories\PermanentlyDeleteTrashedBlogCategoriesAction;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedBlogCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog-categories:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blog categories in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedBlogCategories = BlogCategory::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedBlogCategoriesAction())->handle($trashedBlogCategories);

    }
}
