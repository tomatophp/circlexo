<?php

namespace Modules\TomatoMenus\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $menu_item_id
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 * @property MenusItem $menusItem
 */
class MenusItemsMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus_items_metas';

    /**
     * @var array
     */
    protected $fillable = ['menu_item_id', 'key', 'value', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menusItem()
    {
        return $this->belongsTo('Modules\TomatoMenus\App\Models\MenusItem', 'menu_item_id');
    }
}
