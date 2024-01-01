<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Store;
use Inertia\Response;
use Inertia\ResponseFactory;

class ChatInboxController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $store = Store::select('id')
            ->where('seller_id', auth()->id())
            ->first();

        $conversations = Conversation::with(['conversationMessages.customer:id,name,avatar', 'conversationMessages.store:id,store_name,avatar', 'customer:id,name,avatar', 'store:id,store_name,avatar'])
            ->where('store_id', $store->id)
            ->latest()
            ->get();

        return inertia('Seller/ChatInbox/Index', compact('conversations'));
    }
}
