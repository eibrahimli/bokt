<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BelongsTo;
use App\Models\Loan;

class LoanPenalty extends Model
{
    use HasFactory;

    public function loans() {
        return $this->belongsTo(Loan::class);
    }
}
