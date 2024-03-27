<?php

namespace Modules\TomatoCms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property integer $id
 * @property string $name
 * @property string $alt
 * @property string $url
 * @property string $description
 * @property string $by
 * @property boolean $activated
 * @property float $views
 * @property string $created_at
 * @property string $updated_at
 */
class Photo extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @var array
     */
    protected $fillable = ['name', 'alt', 'url', 'description', 'by', 'activated', 'views', 'created_at', 'updated_at'];

    protected $casts = [
        'activated' => 'boolean'
    ];
}
