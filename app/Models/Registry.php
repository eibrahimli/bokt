<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registry extends Model
{
    use HasFactory;

    public $table = 'registries';

    public static function allDebetCredit($request)
    {
        $datas = [] ;
        $main_ids = [];
        $m_ids = [];
        $accounts = \App\Models\DcAccount::all();
        foreach ($accounts as $account){
            if($account->is_main>0){
                $main_ids[] = $account->code;
            }
            $datas[$account->code] = [
                "code" => $account->code,
                "name" => $account->name,
                "operations" => [
                    "debet" => [
                        "first" => 0 ,"current" => 0, "last" => 0
                    ],
                    "credit"  => [
                        "first" => 0 ,"current" => 0, "last" => 0
                    ],
                ]
            ];
        }

        $dc_account_id = intval($request->get("dc_account_id",0));
        $branch_id = $request->get("branch_id",0);
        $account_id = $request->get("account_id",0);
        $account_to = $request->get("account_to",0);
        $supplier_id = $request->get("supplier_id",0);
        $check_null = $request->get("check_null",0);
        $begin_date = $request->get("begin_date",0);
        $end_date = $request->get("end_date",0);
        $all = Registry::where("amount",">",0);


        if($begin_date == null and $end_date == null){
            $begin = $end = date("Y-m-d");
        }elseif ($begin_date == null){
            $begin = '1970-01-01';
            $end = $end_date;
        }elseif($end_date == null){
            $begin = $begin_date;
            $end = date("Y-m-d");
        }else{
            $begin = $begin_date;
            $end = $end_date;
        }

        $begin = date("Y-m-d",strtotime($begin));
        $end = date("Y-m-d",strtotime($end));

        if($branch_id>0){
            $all = $all->where("branch_id",$branch_id);
        }

        if($supplier_id>0){
            $all = $all->where("supplier_id",$supplier_id);
        }

        if($account_id>0){
            $all = $all->where("account_id",$account_id);
        }

        if($account_to>0){
            $all = $all->where("account_to",$account_to);
        }

        if($dc_account_id > 0){
            $all = $all->where(function ($query) use ($dc_account_id) {
                $query->orWhere('debet', '=', $dc_account_id)
                    ->orWhere('credit', '=', $dc_account_id);
            });
        }

        $all = $all->get();

        foreach ($all as $a){
            $created_at = date("Y-m-d",strtotime($a->created_at));
            if($created_at>=$begin and $created_at<=$end){
                $type = 'current';
            }elseif($created_at<$begin){
                $type = 'first';
            }


            if($a->debet>0 and isset($datas[$a->debet])){
                if(in_array($a->debet,$main_ids)){
                    if(!in_array($a->debet,$m_ids)) $m_ids[] = $a->debet;
                }else{
                    $old = $datas[$a->debet]["operations"]["debet"][$type];
                    $price = $a->amount;
                    $new = $old+$price;
                    $datas[$a->debet]["operations"]["debet"][$type] = $new;
                }

            }

            if($a->credit>0 and  isset($datas[$a->credit])){
                if(in_array($a->credit,$main_ids)){
                    if(!in_array($a->credit,$m_ids)) $m_ids[] = $a->credit;
                }else {
                    $old = $datas[$a->credit]["operations"]["credit"][$type];
                    $price = $a->amount;
                    $new = $old + $price;
                    $datas[$a->credit]["operations"]["credit"][$type] = $new;
                }
            }
        }

        if(count($m_ids)>0){
            $all = Registry::where("amount",">",0)
                ->where(function ($query) use ($m_ids) {
                    $query->orWhereIn("debet",$m_ids)->orWhereIn("credit",$m_ids);
                })
                ->get();
            foreach ($all as $a){
                $created_at = date("Y-m-d",strtotime($a->created_at));
                if($created_at>=$begin and $created_at<=$end){
                    $type = 'current';
                }elseif($created_at<$begin){
                    $type = 'first';
                }


                if($a->debet>0 and isset($datas[$a->debet]) and in_array($a->debet,$m_ids)){
                    $old = $datas[$a->debet]["operations"]["debet"][$type];
                    $price = $a->amount;
                    $new = $old+$price;
                    $datas[$a->debet]["operations"]["debet"][$type] = $new;
                }

                if($a->credit>0 and  isset($datas[$a->credit]) and in_array($a->credit,$m_ids)){
                    $old = $datas[$a->credit]["operations"]["credit"][$type];
                    $price = $a->amount;
                    $new = $old + $price;
                    $datas[$a->credit]["operations"]["credit"][$type] = $new;

                }
            }

        }

        foreach ($datas as $code=>$d){
            if($check_null==1  and $datas[$code]["operations"]["debet"]["first"]==0 and $datas[$code]["operations"]["credit"]["first"]==0 and
                $datas[$code]["operations"]["debet"]["current"] == 0 and $datas[$code]["operations"]["credit"]["current"]==0){
                unset($datas[$code]);
            }else{
                $datas[$code]["operations"]["debet"]["last"] = $datas[$code]["operations"]["debet"]["first"]+$datas[$code]["operations"]["debet"]["current"]-$datas[$code]["operations"]["credit"]["current"];
                if($datas[$code]["operations"]["debet"]["last"]<0){
                    $datas[$code]["operations"]["debet"]["last"] = 0;
                }
                $datas[$code]["operations"]["credit"]["last"] =$datas[$code]["operations"]["credit"]["first"]+$datas[$code]["operations"]["credit"]["current"]-$datas[$code]["operations"]["debet"]["current"];;
                if($datas[$code]["operations"]["credit"]["last"]<0){
                    $datas[$code]["operations"]["credit"]["last"] = 0;
                }
            }
         }

        return $datas;
    }

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }

    public function work(): BelongsTo
    {
        return $this->belongsTo('App\Models\Work', 'work_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function accountTo(): BelongsTo
    {
        return $this->belongsTo('App\Models\Account', 'account_to', 'id');
    }

    public function debetAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DcAccount', 'debet', 'code');
    }

    public function creditAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DcAccount', 'credit', 'code');
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}
