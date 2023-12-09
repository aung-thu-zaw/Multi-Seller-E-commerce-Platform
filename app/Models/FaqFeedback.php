<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqFeedback extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<FaqContent,FaqFeedback>
     */
    public function faqContent(): BelongsTo
    {
        return $this->belongsTo(FaqContent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,FaqFeedback>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
