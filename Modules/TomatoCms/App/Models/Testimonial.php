<?php

namespace Modules\TomatoCms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoCms\App\Models\Service;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property integer $service_id
 * @property string $name
 * @property string $position
 * @property string $company
 * @property string $comment
 * @property float $rate
 * @property string $created_at
 * @property string $updated_at
 * @property Service $service
 */
class Testimonial extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'position',
        'company',
        'comment',
    ];

    /**
     * @var array
     */
    protected $fillable = ['service_id', 'name', 'position', 'company', 'comment', 'rate', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
