<?php

namespace Modules\CircleNotes\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * @property \Modules\CircleNotes\App\Models\CircleXoNote $note_id
 * @property string $token
 */
class CircleXoNoteLink extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'note_id',
        'token'
    ];

    public function note()
    {
        return $this->belongsTo(CircleXoNote::class, 'note_id');
    }
}
