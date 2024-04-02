<?php

namespace Modules\CircleNotes\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
* @property string $id
* @property string $title
* @property string $slug
* @property string $content
* @property \App\Models\Account $account_id
 */
class CircleXoNote extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'account_id',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function links()
    {
        return $this->hasMany(CircleXoNoteLink::class, 'note_id');
    }

}
