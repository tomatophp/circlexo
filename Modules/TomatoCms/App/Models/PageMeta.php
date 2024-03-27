<?php

namespace Modules\TomatoCms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $account_id
 * @property integer $model_id
 * @property string $model_type
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 * @property Page $page
 */
class PageMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['page_id', 'model_id', 'model_type', 'key', 'value', 'created_at', 'updated_at'];

    protected $casts = [
        'value' => 'json',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo('Modules\TomatoCms\App\Models\Page');
    }
}
