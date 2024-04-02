<?php

namespace Modules\CircleDocs\App\Models;

use Illuminate\Database\Eloquent\Model;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
* @property string $name
* @property string $package
* @property string $about
* @property string $repository
* @property string $branch
* @property string $readme
* @property string $is_active
* @property string $is_public
* @property string $group
* @property \App\Models\Account $account_id
 */
class CircleXoDoc extends Model implements HasMedia
{
    use InteractsWithMedia;
    use CanBeLiked;


    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'package',
        'about',
        'repository',
        'branch',
        'readme',
        'is_active',
        'is_public',
        'account_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_public' => 'boolean'
    ];



    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function pages()
    {
        return $this->hasMany(\Modules\CircleDocs\App\Models\CircleXoDocsPage::class, 'doc_id', 'id');
    }
}
