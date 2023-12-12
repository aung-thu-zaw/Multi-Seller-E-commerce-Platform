<?php

namespace App\Actions\Admin\Subscribers;

use App\Models\Subscriber;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedSubscribersAction
{
    /**
     * @param  Collection<int,Subscriber>  $subscribers
     */
    public function handle(Collection $subscribers): void
    {
        $subscribers->each(function ($subscriber) {

            $subscriber->forceDelete();

        });
    }
}
