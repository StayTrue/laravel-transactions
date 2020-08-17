<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Transaction type income
     *
     * @var string
     */
    public const TYPE_INCOME = 'income';

    /**
     * Transaction type expense
     *
     * @var string
     */
    public const TYPE_EXPENSE = 'expense';

    /**
     * Available transaction types
     *
     * @var array
     */
    public const AVAILABLE_TYPES = [
        self::TYPE_INCOME,
        self::TYPE_EXPENSE,
    ];

    /**
     * Order type by date
     *
     * @var string
     */
    public const ORDER_BY_DATE = 'date';

    /**
     * Available order types
     *
     * @var array
     */
    public const AVAILABLE_ORDER_BY = [
        self::ORDER_BY_DATE,
    ];

    /**
     * Get transaction currency
     *
     * @return string
     */
    public function currency()
    {
        return $this->user->currency;
    }

    /**
     * @param $value
     *
     * @return float
     */
    public function getAmountAttribute($value)
    {
        return (float) number_format(
            CurrencyHelper::getCurrencyRate($this->currency(), $this->date) * $value,
            2,
            '.',
            ''
        );
    }

    public function getTotalAmountAttribute()
    {
        $totalAmount = 0;
        $transactions = self::whereDate('date', Carbon::createFromTimeString($this->date)->format('Y-m-d'))->get();
        foreach ($transactions as $transaction)
        {
            if ($transaction->type === self::TYPE_INCOME) {
                $totalAmount += $transaction->amount;
                continue;
            }
            $totalAmount -= $transaction->amount;
        }
        return $totalAmount;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'type', 'date'
    ];

    /**
     * List of visible attributes
     *
     * @var array
     */
    protected $visible = [
        'amount', 'type', 'date', 'total_amount',
    ];

    /**
     * Get user belongs to transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
