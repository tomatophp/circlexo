<?php

namespace Modules\CircleDocs\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
* @property string $title
* @property string $description
* @property string $body
* @property string $parent_id
* @property string $icon
* @property string $color
* @property string $slug
* @property \Modules\CircleDocs\App\Models\CircleXoDoc $doc_id
 */
class CircleXoDocsPage extends Model implements HasMedia
{
    use Searchable;
    use InteractsWithMedia;
    use CanBeLiked;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'body',
        'parent_id',
        'icon',
        'color',
        'slug',
        'group',
        'doc_id'
    ];

    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with('doc');
    }

    public function searchableAs(): string
    {
        return $this->doc->id.'_title_body_index';
    }

    public function doc()
    {
        return $this->belongsTo(\Modules\CircleDocs\App\Models\CircleXoDoc::class, 'doc_id', 'id');
    }
}
