<?php

namespace Modules\CircleDocs\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
* @property string $key
* @property string $value
* @property string $type
* @property \Modules\CircleDocs\App\Models\CircleXoDocsPage $docs_page_id
 */
class CircleXoDocsPagesMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'key',
        'value',
        'type',
        'docs_page_id'
    ];

    protected $casts = [
        'value' => 'json'
    ];

    public function docsPage()
    {
        return $this->belongsTo(\Modules\CircleDocs\App\Models\CircleXoDocsPage);
    }
}
