<?php

namespace Eibrahimli\MonthlyCreditPaymentReport\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mortgage\Facades\Annuity;

class CreditPaymentController extends \App\Http\Controllers\Controller
{
    public function calculate(Request $request): \Illuminate\Http\JsonResponse
    {
        $validate = Validator::make($request->all(), [
           'month' => 'required',
           'percentage' => 'required',
           'price' => 'required',
        ]);

        if($validate->fails()) {
            return response()->json(['status' => $validate->errors()],422);
        }

        $data = $validate->validated();

        config(['mortgage.loanTerm' => $data['month'], 'mortgage.loanAmount' => $data['price'], 'mortgage.loanAmount' => $data['percentage']]);
        $report = Annuity::showRepaymentSchedule();

        return response()->json([$report->toArray()]);
    }
}
