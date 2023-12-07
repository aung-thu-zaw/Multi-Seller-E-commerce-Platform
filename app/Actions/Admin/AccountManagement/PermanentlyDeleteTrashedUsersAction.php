<?php

namespace App\Actions\Admin\AccountManagement;

use Illuminate\Support\Collection;
use App\Models\User;

class PermanentlyDeleteTrashedUsersAction
{
    /**
     * @param  Collection<int,User>  $users
     */

    public function handle(Collection $users): void
    {
        $users->each(function ($user) {

            User::deleteAvatar($user->avatar);

            $user->forceDelete();

        });
    }
}
