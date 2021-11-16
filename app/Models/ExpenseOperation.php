<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseOperation extends Model
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
}
