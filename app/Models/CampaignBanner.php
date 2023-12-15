<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class CampaignBanner extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    /**
    *     @return array<string>
    */
    public function toSearchableArray(): array
    {
        return [
            'url' => $this->url,
        ];
    }

    /**
    * @return \Illuminate\Database\Eloquent\Casts\Attribute<CampaignBanner, never>
    */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, "http") ? $value : asset("storage/campaign-banners/$value"),
        );
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public static function deleteImage(string $campaignBannerImage): void
    {
        if (!empty($campaignBannerImage) && file_exists(storage_path("app/public/campaign-banners/".pathinfo($campaignBannerImage, PATHINFO_BASENAME)))) {
            unlink(storage_path("app/public/campaign-banners/".pathinfo($campaignBannerImage, PATHINFO_BASENAME)));
        }
    }
}
