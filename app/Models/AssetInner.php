<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetInner extends Model
{
    use HasFactory;

    public $table = 'asset_inner';

    public function assetCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\AssetCategory', 'type', 'id');
    }

    public function asset(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\MainAsset', 'asset_id', 'id');
    }
}
