<?php

namespace Modules\TomatoCms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $exp
 * @property string $icon
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 */
class Skill extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;

    public $translatable = [
        'name',
        'description'
    ];

    /**
     * @var array
     */
    protected $fillable = ['url','name', 'description', 'exp', 'icon', 'created_at', 'updated_at'];
}
