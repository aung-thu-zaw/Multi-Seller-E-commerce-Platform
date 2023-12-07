<?php

namespace App\Actions\Admin\AuthorityManagement;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;

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
