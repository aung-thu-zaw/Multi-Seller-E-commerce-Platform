<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogTag extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<BlogTag, never>
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<BlogContent>
     */
    public function blogContents(): BelongsToMany
    {
        return $this->belongsToMany(BlogContent::class, 'blog_content_blog_tag');
    }
}
