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
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,ConversationMessage>
    */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany<MessageFileAttachment>
    */
    public function messageFileAttachments(): HasMany
    {
        return $this->hasMany(MessageFileAttachment::class);
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
