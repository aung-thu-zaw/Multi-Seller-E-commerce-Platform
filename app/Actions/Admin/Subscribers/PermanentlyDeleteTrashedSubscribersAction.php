<?php

namespace App\Actions\Admin\Subscribers;

use Illuminate\Support\Collection;
use App\Models\Subscriber;

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
