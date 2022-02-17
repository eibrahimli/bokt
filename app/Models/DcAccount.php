<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcAccount extends Model
{
    use HasFactory;

    public function workInnerDebet(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\WorkInner', 'debet', 'id');
    }



}
