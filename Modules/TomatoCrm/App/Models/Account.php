<?php

namespace Modules\TomatoCrm\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $loginBy
 * @property string $type
 * @property string $address
 * @property string $password
 * @property string $otp_code
 * @property string $otp_activated_at
 * @property string $last_login
 * @property string $agent
 * @property string $host
 * @property integer $attempts
 * @property boolean $login
 * @property boolean $activated
 * @property boolean $blocked
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AccountsMeta[] $accountsMetas
 * @property Activity[] $activities
 * @property Comment[] $comments
 * @property Model meta($key, $value)
 * @property Location[] $locations
 */
class Account extends Authenticatable implements HasMedia
{
    use InteractsWithMedia;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'phone',
        'parent_id',
        'type',
        'name',
        'username',
        'loginBy',
        'address',
        'password',
        'otp_code',
        'otp_activated_at',
        'last_login',
        'agent',
        'host',
        'is_login',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_login' => 'boolean',
        'is_active' => 'boolean'
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
        'otp_activated_at',
        'last_login',
    ];


    protected $appends = [
        'birthday',
        'gender',
        'more'
    ];

    public function getMoreAttribute()
    {
        $metas = $this->accountsMetas()->get()->pluck('value', 'key')->toArray();
        return $metas;
    }

    public function getBirthdayAttribute()
    {
        return $this->meta('birthday') ?: null;
    }

    public function getGenderAttribute()
    {
        return $this->meta('gender') ?: null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountsMetas()
    {
        return $this->hasMany('Modules\TomatoCrm\App\Models\AccountsMeta');
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return Model|string
     */
    public function meta(string $key, string|null $value=null): Model|string|null
    {
        if($value!==null){
            return $this->accountsMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->accountsMetas()->where('key', $key)->first()?->value;
        }
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('Modules\TomatoCrm\App\Models\Activity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Modules\TomatoCrm\App\Models\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('Modules\TomatoCrm\App\Models\Location');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'account_groups', 'account_id', 'group_id');
    }
}
