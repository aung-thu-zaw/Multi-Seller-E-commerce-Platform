<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Faqs\PermanentlyDeleteTrashedFaqContentsAction;
use App\Models\FaqContent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedFaqContents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faq-contents:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Faq contents in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedFaqContents = FaqContent::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedFaqContentsAction())->handle($trashedFaqContents);

    }
}
