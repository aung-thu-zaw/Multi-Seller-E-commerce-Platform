<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Faqs\FaqCategories\PermanentlyDeleteTrashedFaqCategoriesAction;
use App\Models\FaqCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedFaqCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faq-categories:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Faq categories in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedFaqCategories = FaqCategory::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedFaqCategoriesAction())->handle($trashedFaqCategories);

    }
}
