<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    use HasFactory;

    public $table = 'registries';

    public static function allDebetCredit($request)
    {
        $datas = [] ;
        $accounts = \App\Models\DcAccount::all();
        foreach ($accounts as $account){
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

        if($dc_account_id > 0){
            $all = $all->where(function ($query) use ($dc_account_id) {
                $query->orWhere('debet', '=', $dc_account_id)
                    ->orWhere('credit', '=', $dc_account_id);
            });
        }

        $all = $all->get();

        foreach ($all as $a){
            if($a->created_at>=$begin and $a->created_at<=$end){
                $type = 'current';
            }elseif($a->created_at<$begin){
                $type = 'first';
            }


            if($a->debet>0 and isset($datas[$a->debet])){
                $old = $datas[$a->debet]["operations"]["debet"][$type];
                $price = $a->amount;
                $new = $old+$price;
                $datas[$a->debet]["operations"]["debet"][$type] = $new;
            }

            if($a->credit>0 and  isset($datas[$a->credit])){
                $old = $datas[$a->credit]["operations"]["credit"][$type];
                $price = $a->amount;
                $new = $old+$price;
                $datas[$a->debet]["operations"]["credit"][$type] = $new;
            }
        }

        foreach ($datas as $code=>$d){
            if($check_null==1  and $datas[$code]["operations"]["debet"]["first"]==0 and $datas[$code]["operations"]["credit"]["first"]==0 and
                $datas[$code]["operations"]["debet"]["current"] == 0 and $datas[$code]["operations"]["credit"]["current"]==0){
                unset($datas[$code]);
            }else{
                $datas[$code]["operations"]["debet"]["last"] = $datas[$code]["operations"]["debet"]["first"]+$datas[$code]["operations"]["debet"]["current"]-$datas[$code]["operations"]["credit"]["current"];
                $datas[$code]["operations"]["credit"]["last"] =$datas[$code]["operations"]["credit"]["first"]+$datas[$code]["operations"]["credit"]["current"]-$datas[$code]["operations"]["debet"]["current"];;

            }
         }
        return $datas;
    }
}
