<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanReport extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function loan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('paid', false);
    }

    public static function scopeStopPenalty($query) {
        return $query->where('stopPenalty', 0);
    }
}
