<?php

namespace Modules\CircleXO\App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanBeViewed;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AccountListing extends Model implements HasMedia
{
    use InteractsWithMedia;
    use CanBeLiked;
    use CanBeViewed;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'account_id',
        'type',
        'title',
        'body',
        'url',
        'icon',
        'color',
        'description',
        'order',
        'is_active',
        'price',
        'discount',
        'rating',
        'views',
        'likes',
        'share',
        'currency'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
