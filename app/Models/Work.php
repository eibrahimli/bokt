<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    use HasFactory;

    protected $casts = [
        'contract_begin' => 'date',
        'contract_end' => 'date',
        'contract_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();


    }

    public function contract(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contract::class);

    }


    public function workInner(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\WorkInner', 'work_id', 'id');
    }

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }





}
