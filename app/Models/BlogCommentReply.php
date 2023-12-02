<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class BlogCommentReply extends Model
{
    use HasFactory;
    use Searchable;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<BlogComment,BlogCommentReply>
     */
    public function blogComment(): BelongsTo
    {
        return $this->belongsTo(BlogComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,BlogCommentReply>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<BlogCommentReply, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j/F/Y h:i A', strtotime($value)),
        );
    }
}
