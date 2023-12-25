<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConversationMessage extends Model
{
    use HasFactory;
    
    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,ConversationMessage>
    */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, "sender_id");
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,ConversationMessage>
    */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, "receiver_id");
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany<ConversationFileAttachment>
    */
    public function conversationFileAttachments(): HasMany
    {
        return $this->hasMany(ConversationFileAttachment::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ConversationMessage,ConversationMessage>
    */
    public function replyToMessage(): BelongsTo
    {
        return $this->belongsTo(ConversationMessage::class, 'reply_to_message_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany<ConversationMessage>
    */
    public function replies(): HasMany
    {
        return $this->hasMany(ConversationMessage::class, 'reply_to_message_id');
    }
}
