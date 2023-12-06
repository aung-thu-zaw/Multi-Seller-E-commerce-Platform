<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Faqs\FaqCategories\PermanentlyDeleteTrashedFaqCategoriesAction;
use App\Actions\Admin\Faqs\FaqSubcategories\PermanentlyDeleteTrashedFaqSubcategoriesAction;
use App\Models\FaqCategory;
use App\Models\FaqSubcategory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedFaqSubcategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faq-subcategories:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Faq subcategories in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedFaqSubcategories = FaqSubcategory::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedFaqSubcategoriesAction())->handle($trashedFaqSubcategories);

    }
}
