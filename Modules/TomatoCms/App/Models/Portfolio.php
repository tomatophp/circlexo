<?php

namespace Modules\TomatoCms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoCms\App\Models\Service;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property integer $service_id
 * @property string $title
 * @property string $short_description
 * @property string $keywords
 * @property string $company
 * @property string $start_at
 * @property string $end_at
 * @property string $body
 * @property boolean $activated
 * @property float $views
 * @property string $created_at
 * @property string $updated_at
 * @property Service $service
 */
class Portfolio extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = [
        'title',
        'short_description',
        'keywords',
        'company',
        'body',
    ];

    /**
     * @var array
     */
    protected $fillable = ['service_id', 'title', 'short_description', 'keywords', 'company', 'start_at', 'end_at', 'body', 'activated', 'views', 'created_at', 'updated_at'];

    protected $casts = [
        'activated' => 'boolean',
        'views' => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
