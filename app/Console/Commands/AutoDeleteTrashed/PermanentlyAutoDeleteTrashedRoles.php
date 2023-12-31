<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\AuthorityManagement\PermanentlyDeleteTrashedRolesAction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class PermanentlyAutoDeleteTrashedRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roles in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedRoles = Role::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedRolesAction())->handle($trashedRoles);

    }
}
