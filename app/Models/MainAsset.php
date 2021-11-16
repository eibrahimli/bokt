<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainAsset extends Model
{
    use HasFactory;

    protected $casts = [
        'einvoice_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
            $branch_id = 0;
            $supplier_id = 0;
            if($model->contract_id > 0){
                $contract = Contract::find($model->contract_id);
                if($contract!=null){
                    $branch_id = $contract->branch_id;
                    $supplier_id = $contract->supplier_id;
                }
            }
            $model->branch_id = $branch_id;
            $model->supplier_id = $supplier_id;
        });


        self::updating(function($model){
            // ... code here
            $branch_id = 0;
            $supplier_id = 0;
            if($model->contract_id > 0){
                $contract = Contract::find($model->contract_id);
                if($contract!=null){
                    $branch_id = $contract->branch_id;
                    $supplier_id = $contract->supplier_id;
                }
            }
            $model->branch_id = $branch_id;
            $model->supplier_id = $supplier_id;
        });



    }

    public function contract(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Contract', 'contract_id', 'id');
    }

    public function depAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DepreciationAccount', 'dep_account_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function assetInner(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\AssetInner', 'asset_id', 'id');
    }

}
