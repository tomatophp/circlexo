<?php

namespace Modules\TomatoCms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property string $color
 * @property mixed $title
 * @property mixed $short_description
 * @property string $slug
 * @property mixed $body
 * @property boolean $is_active
 * @property boolean $has_view
 * @property string $view
 * @property string $created_at
 * @property string $updated_at
 */
class Page extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    protected $casts = [
        'is_active' => 'boolean',
        'has_view' => 'boolean',
        'lock' => 'boolean',
    ];

    public $translatable = ['title', 'short_description', 'body','keywords'];
    /**
     * @var array
     */
    protected $fillable = ['lock','color', 'title', 'short_description','keywords', 'slug', 'body', 'is_active', 'has_view', 'view', 'created_at', 'updated_at'];


    public function pageMetas()
    {
        return $this->hasMany('Modules\TomatoCms\App\Models\PageMeta');
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return Model|string
     */
    public function meta(string $key, mixed $value=null): mixed
    {
        if($value){
            return $this->pageMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else if($value === []){
            return $this->pageMetas()->updateOrCreate(['key' => $key], ['value' => []]);
        }
        else if($value === false){
            return $this->pageMetas()->updateOrCreate(['key' => $key], ['value' => false]);
        }
        else {
            return $this->pageMetas()->where('key', $key)->first()?->value;
        }
    }
}
