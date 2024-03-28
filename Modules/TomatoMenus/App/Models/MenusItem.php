<?php

namespace Modules\TomatoMenus\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property integer $menu_id
 * @property integer $parent_id
 * @property integer $model_id
 * @property string $model_type
 * @property integer $order
 * @property string $url
 * @property string $target
 * @property string $name
 * @property string $bg
 * @property string $color
 * @property string $description
 * @property string $icon
 * @property string $can
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property Menu $menu
 * @property MenusItem $menusItem
 * @property MenusItemsMeta[] $menusItemsMetas
 */
class MenusItem extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus_items';

    /**
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'model_id',
        'model_type',
        'order',
        'url',
        'target',
        'name',
        'bg',
        'color',
        'description',
        'icon',
        'can',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('Modules\TomatoMenus\App\Models\Menu');
    }


    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany('Modules\TomatoMenus\App\Models\MenusItem', 'parent_id')->orderBy('order', 'asc')->with('children');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menusItemsMetas()
    {
        return $this->hasMany('Modules\TomatoMenus\App\Models\MenusItemsMeta', 'menu_item_id');
    }
}
