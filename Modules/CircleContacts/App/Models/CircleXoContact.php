<?php

namespace Modules\CircleContacts\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
* @property string $name
* @property string $email
* @property string $phone
* @property string $address
* @property string $company
* @property string $type
* @property \App\Models\Account $account_id
 */
class CircleXoContact extends Model implements HasMedia
{
    use InteractsWithMedia;
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'company',
        'type',
        'account_id'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function groups()
    {
        return $this->belongsToMany('Modules\CircleContacts\App\Models\CircleXoContactsGroup', 'circle_xo_contacts_has_groups', 'contact_id', 'group_id');
    }

    public function contactMeta()
    {
        return $this->hasMany('Modules\CircleContacts\App\Models\CircleXoContactsMeta', 'contact_id', 'id');
    }
}
