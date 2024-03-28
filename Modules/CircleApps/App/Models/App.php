<?php

namespace Modules\CircleApps\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoCategory\App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
* @property \App\Models\Account $account_id
* @property string $name
* @property string $key
* @property string $readme
* @property string $homepage
* @property string $email
* @property string $docs
* @property string $github
* @property string $privacy
* @property string $faq
* @property string $status
* @property bool $is_active
* @property int $price
* @property int $discount
* @property string $discount_to
* @property bool $is_free
 */
class App extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'account_id',
        'name',
        'description',
        'key',
        'readme',
        'homepage',
        'email',
        'docs',
        'github',
        'privacy',
        'faq',
        'status',
        'is_active',
        'price',
        'price_per',
        'discount',
        'discount_to',
        'is_free'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_free' => 'boolean'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'apps_has_categories', 'app_id', 'category_id');
    }
}
