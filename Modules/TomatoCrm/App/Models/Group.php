<?php

namespace Modules\TomatoCrm\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\TomatoCrm\App\Models\Account;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property mixed $name
 * @property string $created_at
 * @property string $updated_at
 * @property UsersGroup[] $usersGroups
 */
class Group extends Model
{
    use HasTranslations;
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'created_at',
        'updated_at'
    ];

    public $translatable = ['name', 'description'];


    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_groups', 'group_id', 'account_id');
    }
}
