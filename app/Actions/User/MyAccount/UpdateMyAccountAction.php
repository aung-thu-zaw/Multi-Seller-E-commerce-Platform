<?php

namespace App\Actions\User\MyAccount;

use App\Http\Traits\ImageUpload;
use App\Models\User;
use Carbon\Carbon;

class UpdateMyAccountAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, User $user): void
    {
        $avatar = isset($data['avatar']) && !is_string($data['avatar']) ? $this->updateImage($data['avatar'], $user->avatar, 'avatars/users') : $user->avatar;

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            // 'birthday' => Carbon::parse($data['birthday'])->format("Y-m-d"),
            'avatar' => $avatar,
        ]);
    }
}
