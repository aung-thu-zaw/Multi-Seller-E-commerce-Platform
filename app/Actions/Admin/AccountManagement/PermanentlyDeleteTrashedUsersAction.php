<?php

namespace App\Actions\Admin\AccountManagement;

use App\Models\User;
use Illuminate\Support\Collection;

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
