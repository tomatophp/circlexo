<?php

namespace Modules\TomatoSupport\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property integer $type_id
 * @property mixed $qa
 * @property mixed $answer
 * @property string $created_at
 * @property string $updated_at
 * @property Type $type
 */
class Question extends Model
{
    use HasTranslations;

    /**
     * @var array
     */
    protected $fillable = ['type_id', 'qa', 'answer', 'created_at', 'updated_at'];

    protected $translatable = ['qa', 'answer'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('Modules\TomatoCategory\App\Models\Type');
    }
}
