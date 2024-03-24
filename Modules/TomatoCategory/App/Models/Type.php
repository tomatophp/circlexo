<?php

namespace Modules\TomatoCategory\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property string $description
 * @property string $color
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 * @property Contact[] $contacts
 * @property Content[] $contents
 * @property Typable[] $typables
 */
class Type extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasTranslations;

    public $translatable = ['name','description'];

    /**
     * @var array
     */
    protected $fillable = ['for','name', 'key','type', 'description', 'color', 'icon', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany('Modules\TomatoCategory\App\Models\Contact');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany('Modules\TomatoCategory\App\Models\Content');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function typables()
    {
        return $this->hasMany('Modules\TomatoCategory\App\Models\Typable');
    }
}
