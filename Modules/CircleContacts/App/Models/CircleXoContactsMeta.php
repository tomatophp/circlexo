<?php

namespace Modules\CircleContacts\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
* @property string $key
* @property string $value
* @property \Modules\CircleContacts\App\Models\CircleXoContact $contact_id
 */
class CircleXoContactsMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'key',
        'value',
        'contact_id'
    ];

    protected $casts = [
        'value' => 'json'
    ];



    public function contact()
    {
        return $this->belongsTo(\Modules\CircleContacts\App\Models\CircleXoContact::class);
    }
}
