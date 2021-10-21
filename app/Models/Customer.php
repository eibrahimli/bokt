<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Customer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes,InteractsWithMedia;


    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function getTitleAttribute(): string
    {
        return implode('-', [$this->id,"$this->name $this->surname",$this->fin]);
    }

    public function guarantors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Guarantor::class);
    }

    public function loans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Loan::class);
    }
    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
