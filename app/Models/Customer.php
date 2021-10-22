<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KirschbaumDevelopment\NovaChartjs\Contracts\Chartable;
use KirschbaumDevelopment\NovaChartjs\Traits\HasChart;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Customer extends Model implements HasMedia, Chartable
{
    use HasFactory, SoftDeletes,InteractsWithMedia,HasChart;
    public static function getNovaChartjsSettings(): array
    {
        return [
            'default' => [
                'type' => 'line',
                'titleProp' => 'name',
                'identProp' => 'id',
                'height' => 400,
                'indexColor' => '#999999',
                'color' => '#FF0000',
                'parameters' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                'options' => ['responsive' => true, 'maintainAspectRatio' => false],
            ]
        ];
    }

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
