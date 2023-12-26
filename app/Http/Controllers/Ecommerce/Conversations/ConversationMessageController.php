<?php

namespace App\Http\Controllers\Ecommerce\Conversations;

use App\Events\ConversationMessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\ConversationMessageRequest;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\MessageFileAttachment;
use App\Services\AttachmentFileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConversationMessageController extends Controller
{
    public function store(ConversationMessageRequest $request, Conversation $conversation): RedirectResponse
    {
        $message = ConversationMessage::create([
            "conversation_id" => $conversation->id,
            "customer_id" => $request->customer_id,
            "store_id" => $request->store_id,
            'message' => $request->message,
            'reply_to_message_id' => $request->reply_to_message_id ?? null,
        ]);

        // if($request->files) {

        //     (new AttachmentFileUploadService())->upload($request->files, $message->id);

        // }

        $message->load(["messageFileAttachments","customer:id,name,avatar","store:id,store_name,avatar","replyToMessage"]);

        broadcast(new ConversationMessageSent($conversation, $message));

        return back();
    }
}
