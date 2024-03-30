<?php

namespace Modules\CircleContacts\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
* @property \App\Models\Account $account_id
* @property string $name
* @property string $description
* @property string $icon
* @property string $color
 */
class CircleXoContactsGroup extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'account_id',
        'name',
        'description',
        'icon',
        'color'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
