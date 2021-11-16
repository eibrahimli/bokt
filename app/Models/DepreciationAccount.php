<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepreciationAccount extends Model
{
    use HasFactory;

    public function assets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\MainAsset', 'dep_account_id', 'id');
    }
}
