<?php

namespace Modules\TomatoThemes\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property mixed $title
 * @property mixed $description
 * @property string $icon
 * @property string $icon_color
 * @property string $icon_bg_color
 * @property string $created_at
 * @property string $updated_at
 */
class Feature extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'icon', 'icon_color', 'icon_bg_color', 'created_at', 'updated_at'];
}
