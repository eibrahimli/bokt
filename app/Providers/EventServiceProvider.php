<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\ExpenseOperation;
use App\Models\Guarantor;
use App\Models\IncomeOperation;
use App\Models\Loan;
use App\Models\MainAsset;
use App\Models\Transaction;
use App\Models\Work;
use App\Models\WorkInner;
use App\Observers\CustomerObserver;
use App\Observers\ExpenseOperationObserver;
use App\Observers\GuarantorObserver;
use App\Observers\IncomeOperationObserver;
use App\Observers\LoanObserver;
use App\Observers\MainAssetObserver;
use App\Observers\TransactionObserver;
use App\Observers\WorkInnerObserver;
use App\Observers\WorkObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Guarantor::observe(GuarantorObserver::class);
        Customer::observe(CustomerObserver::class);
        Transaction::observe(TransactionObserver::class);
        Loan::observe(LoanObserver::class);
        Work::observe(WorkObserver::class);
        WorkInner::observe(WorkInnerObserver::class);
        MainAsset::observe(MainAssetObserver::class);
        ExpenseOperation::observe(ExpenseOperationObserver::class);
        IncomeOperation::observe(IncomeOperationObserver::class);
    }
}
