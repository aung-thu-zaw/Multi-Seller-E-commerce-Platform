<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\RatingManagement\AutomatedFilterWords\PermanentlyDeleteTrashedAutomatedFilterWordsAction;
use App\Actions\Seller\StoreProductCategories\PermanentlyDeleteTrashedStoreProductCategoriesAction;
use App\Models\AutomatedFilterWord;
use App\Models\StoreProductCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedAutomatedFilterWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automated-filter-words:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automated filter words in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedAutomatedFilterWords = AutomatedFilterWord::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedAutomatedFilterWordsAction())->handle($trashedAutomatedFilterWords);

    }
}
