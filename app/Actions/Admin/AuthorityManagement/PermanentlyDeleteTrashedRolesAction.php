<?php

namespace App\Actions\Admin\AuthorityManagement;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class PermanentlyDeleteTrashedRolesAction
{
    /**
     * @param  Collection<int,Role>  $roles
     */
    public function handle(Collection $roles): void
    {
        $roles->each(function ($role) {

            $role->forceDelete();

        });
    }
}
