<?php

namespace Modules\TomatoMenus\App\Models;

use Spatie\Translatable\HasTranslations;
use Modules\TomatoMenus\App\Models\MenusItem;
use Modules\TomatoMenus\App\Models\MenusMeta;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property mixed $locations
 * @property boolean $auto_add_pages
 * @property string $created_at
 * @property string $updated_at
 * @property MenusItem[] $menusItems
 * @property MenusMeta[] $menusMetas
 * @method create(array $array)
 */
class Menu extends Model
{
    use HasTranslations;

    public $translatable = ['name'];


    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
        'locations',
        'auto_add_pages',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        "name" => "array",
        'locations' => 'array',
        'auto_add_pages' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menusItems()
    {
        return $this->hasMany('Modules\TomatoMenus\App\Models\MenusItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menusMetas()
    {
        return $this->hasMany('Modules\TomatoMenus\App\Models\MenusMeta');
    }
}
