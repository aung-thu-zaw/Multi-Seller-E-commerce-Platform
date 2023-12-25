<?php

namespace App\Http\Controllers\Ecommerce\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        Conversation::firstOrCreate(["customer_id" => auth()->id(),"store_id" => $request->store_id]);

        return back();
    }
}
