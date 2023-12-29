<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\GeographicHierarchy\Townships\PermanentlyDeleteTrashedTownshipsAction;
use App\Models\Township;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedTownships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'townships:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Townships in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedTownships = Township::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedTownshipsAction())->handle($trashedTownships);

    }
}
