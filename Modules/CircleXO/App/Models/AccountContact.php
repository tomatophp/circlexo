<?php

namespace Modules\CircleXO\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Account;
class AccountContact extends Model
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'account_id',
        'sender_id',
        'name',
        'email',
        'message',
        'anonymous_message'
    ];

    protected $casts = [
        'anonymous_message' => 'boolean'
    ];


    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function sender()
    {
        return $this->belongsTo(Account::class, 'sender_id');
    }
}
