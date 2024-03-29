<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Scopes\FilterByScope;
use App\Notifications\Auth\ResetPasswordQueued;
use App\Notifications\Auth\VerifyEmailQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFollow\Traits\Follower;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Follower;
    use HasApiTokens;
    use HasFactory;
    use HasPermissions;
    use HasRoles;
    use Notifiable;
    use Searchable;
    use SoftDeletes;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<User, never>
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::needsRehash($value) ? bcrypt($value) : $value,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<User, never>
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || ! $value ? $value : asset("storage/avatars/users/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Store>
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'seller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductReview>
     */
    public function productReviews(): HasMany
    {
        return $this->hasMany(ProductReview::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<StoreReview>
     */
    public function storeReviews(): HasMany
    {
        return $this->hasMany(StoreReview::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<FaqFeedback>
     */
    public function faqFeedbacks(): HasMany
    {
        return $this->hasMany(FaqFeedback::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Wishlist>
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Coupon>
     */
    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'coupon_user')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Product>
     */
    public function viewedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'user_product_views', 'user_id', 'product_id')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductQuestion>
     */
    public function productQuestions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Conversation>
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Cart>
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Address>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    // protected static function booted(): void
    // {
    //     parent::boot();

    //     static::addGlobalScope(new FilterByScope());
    // }

    public function getRedirectRouteName(): string
    {
        return match ((string) $this->role) {
            'admin' => 'admin.dashboard',
            'seller' => 'seller.dashboard',
            'user' => 'home',
        };
    }

    public function logoutRedirect(): string
    {
        return match ((string) $this->role) {
            'admin' => 'admin.login',
            'seller' => 'seller.login',
            'user' => 'home',
        };
    }

    public static function deleteAvatar(?string $avatar): void
    {
        if (! empty($avatar) && file_exists(storage_path('app/public/avatars/users/'.pathinfo($avatar, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/avatars/users/'.pathinfo($avatar, PATHINFO_BASENAME)));
        }
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordQueued($token));
    }
}
