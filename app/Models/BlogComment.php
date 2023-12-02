<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class BlogComment extends Model
{
    use HasFactory;
    use Searchable;

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'comment' => $this->comment,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,BlogComment>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<BlogContent,BlogComment>
     */
    public function blogContent(): BelongsTo
    {
        return $this->belongsTo(BlogContent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<BlogCommentReply>
     */
    public function blogCommentReplies(): HasMany
    {
        return $this->hasMany(BlogCommentReply::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<BlogComment, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j/F/Y h:i A', strtotime($value)),
        );
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }
}
