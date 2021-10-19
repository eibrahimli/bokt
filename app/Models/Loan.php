<?php

namespace App\Models;

use App\Models\Options\Agriculture;
use App\Models\Options\Consumption;
use App\Models\Options\Production;
use App\Models\Options\Service;
use App\Models\Options\Trade;
use App\Models\Options\Transportation;
use App\Models\Options\Trick;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory,SoftDeletes;

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function agriculture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agriculture::class);
    }
    public function consumption(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Consumption::class);
    }
    public function production(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function trade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trade::class);
    }
    public function transportation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Transportation::class);
    }
    public function trick(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trick::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
