<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    /**
     * List of available currencies
     *
     * @var array
     */
    public const AVAILABLE_CURRENCIES = [
        'AUD', 'GBP', 'BYR', 'DKK', 'USD', 'EUR', 'ISK', 'KZT', 'RUB'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'currency'
    ];

    /**
     * List of visible attributes
     *
     * @var array
     */
    protected $visible = [
        'id'
    ];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

}
