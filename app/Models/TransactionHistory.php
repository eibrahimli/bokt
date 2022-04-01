<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transaction_history';

    protected $cast = [
        'old_report_entries' => 'array',
        'current_report_entries' => 'array'
    ];

    protected $fillable = ['old_report_entries','current_report_entries','transaction_id'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
