<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Collections\PermanentlyDeleteTrashedCollectionsAction;
use App\Models\Collection;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collections:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collections in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedCollections = Collection::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedCollectionsAction())->handle($trashedCollections);

    }
}
