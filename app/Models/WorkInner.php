<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInner extends Model
{
    use HasFactory;

    public $table = 'work_inner';

    public function work(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Work', 'work_id', 'id');
    }

    public function assetCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\AssetCategory', 'type', 'id');
    }

    public function measures(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Measure', 'measure', 'id');
    }

    public function debetAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DcAccount', 'debet', 'code');
    }

    public function creditAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DcAccount', 'credit', 'code');
    }
}
