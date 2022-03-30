<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BelongsTo;
use App\Models\Loan;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanPenalty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['loan_id', 'day', 'price', 'price_remainder'];

    public function loans(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }


    public static function scopeUnPaid($query) {
        return $query->where('paid', false);
    }
}
