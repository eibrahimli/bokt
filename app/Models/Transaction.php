<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['service_fee','price','description','expected_price','shouldPay', 'penalty_day', 'penalty'];
    protected $primaryKey = 'id';

    protected $attributes = [
        'type' => 'loan',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function loan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function history(): HasOne {
        return $this->hasOne(TransactionHistory::class);
    }
}
