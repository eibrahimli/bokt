<?php

namespace App\Nova\Dashboards;

use App\Models\Customer;
use App\Models\Transaction;
use App\Nova\Metrics\FakeReceivedTransaction;
use App\Nova\Metrics\FakeTotalTransaction;
use App\Nova\Metrics\LoanIsApproved;
use App\Nova\Metrics\NewCustomer;
use Eibrahimli\BranchsCard\BranchsCard;
use Laravel\Nova\Dashboard;

class LoanDashboards extends Dashboard
{

    public function cards(): array
    {
        return [
            new LoanIsApproved(null,'Təsdiqlənmiş kreditlər',true),
            new LoanIsApproved(null,'Təsdiqlənməmiş kreditlər',false),
            new NewCustomer(),
            new NewCustomer(null, Customer::class,null,'Aktiv Müştərilər'),
            new FakeReceivedTransaction(null,Transaction::class,'Qəbul edilən ödənişlər', 76896),
            new FakeTotalTransaction(),
        ];
    }

    public static function uriKey(): string
    {
        return 'loan-cards';
    }
}
