<?php

namespace Modules\TomatoCategory\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $icon
 * @property string $color
 * @property boolean $activated
 * @property boolean $menu
 * @property string $created_at
 * @property string $updated_at
 * @property Categorable[] $categorables
 * @property Category $category
 * @property CategoriesMeta[] $categoriesMetas
 * @property Content[] $contents
 */
class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = ['name', 'description'];
    /**
     * @var array
     */
    protected $fillable = ['for','parent_id', 'name', 'slug', 'description', 'icon', 'color', 'activated', 'menu', 'created_at', 'updated_at'];


    protected $casts = [
        'activated' => 'boolean',
        'menu' => 'boolean',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categorables()
    {
        return $this->hasMany('Modules\TomatoCategory\App\Models\Categorable');
    }

    public function children()
    {
        return $this->hasMany('Modules\TomatoCategory\App\Models\Category', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('Modules\TomatoCategory\App\Models\Category', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesMetas()
    {
        return $this->hasMany('Modules\TomatoCategory\App\Models\CategoriesMeta');
    }
}
