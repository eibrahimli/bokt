<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
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
        return $this->belongsTo(Contract::class);

    }


    public function workInner(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\WorkInner', 'work_id', 'id');
    }





}
