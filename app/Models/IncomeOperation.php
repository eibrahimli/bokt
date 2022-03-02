<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomeOperation extends Model
{
    use HasFactory;

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo('App\Models\Contract', 'contract_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function accountFrom(): BelongsTo
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function accountTo(): BelongsTo
    {
        return $this->belongsTo('App\Models\Account', 'account_to', 'id');
    }

    public function debetAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DcAccount', 'debet', 'code');
    }

    public function creditAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DcAccount', 'credit', 'code');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
