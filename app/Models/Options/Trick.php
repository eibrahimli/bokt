<?php

namespace App\Models\Options;

use App\Models\Collateral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trick extends Model
{
    use SoftDeletes, HasFactory;

    public function collaterals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collateral::class);
    }
}
