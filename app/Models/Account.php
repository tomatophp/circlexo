<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Modules\TomatoNotifications\App\Traits\InteractWithNotifications;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Multicaret\Acquaintances\Traits\CanView;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Modules\TomatoCrm\App\Models\Group;
use Multicaret\Acquaintances\Traits\CanFollow;
use Multicaret\Acquaintances\Traits\CanBeFollowed;

/**
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $loginBy
 * @property string $address
 * @property string $type
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
    use InteractWithNotifications;
    use CanFollow;
    use CanBeFollowed;
    use CanLike;
    use CanView;
    use Searchable;
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
        'more',
        'avatar',
        'cover',
        'social',
        'bio',
    ];

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'username_index';
    }

    public function getMoreAttribute()
    {
        $metas = $this->accountsMetas()->get()->pluck('value', 'key')->toArray();
        return $metas;
    }

    public function getSocialAttribute()
    {
        return $this->meta('social') ?: null;
    }

    public function getBioAttribute()
    {
        return $this->meta('bio') ?: null;
    }

    public function getAvatarAttribute()
    {
        return $this->getMedia('avatar')->first()?->getUrl() ?: null;
    }

    public function getCoverAttribute()
    {
        return $this->getMedia('cover')->first()?->getUrl() ?: null;
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
    public function meta(string $key, string|array|null $value=null): Model|array|string|null
    {
        if($value){
            return $this->accountsMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->accountsMetas()->where('key', $key)->first()?->value;
        }
    }

    public function metaDestroy(string $key): Model|array|string|null
    {
        return $this->accountsMetas()->updateOrCreate(['key' => $key], ['value' => null]);
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
