<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageFileAttachment extends Model
{
    use HasFactory;

    /**
    * @return \Illuminate\Database\Eloquent\Casts\Attribute<ConversationMessage, never>
    */
    protected function attachmentPath(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($value && str_starts_with($value, "image")) {

                    return asset("storage/conversations/images/$value");

                } elseif ($value && str_starts_with($value, "video")) {

                    return asset("storage/conversations/videos/$value");

                }
            },
        );
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ConversationMessage,MessageFileAttachment>
    */
    public function conversationMessage(): BelongsTo
    {
        return $this->belongsTo(ConversationMessage::class);
    }

}
