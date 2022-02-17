<?php

namespace App\Models;

use App\Models\Options\Agriculture;
use App\Models\Options\Consumption;
use App\Models\Options\Production;
use App\Models\Options\Service;
use App\Models\Options\Trade;
use App\Models\Options\Transportation;
use App\Models\Options\Trick;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['status'];

    protected $with = ['customer'];

    public function getFormattedAttribute() : string {
        return $this->customer->title;
    }

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
    public function collaterals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collateral::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions (): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // Credit report

    public function loanReports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LoanReport::class);
    }

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public static function scopeActive($query) {
        $query->where('status', true);

        return $query;
    }

    public static function scopeUnclosed($query) {
        return $query->where('closed', 0);
    }
}
