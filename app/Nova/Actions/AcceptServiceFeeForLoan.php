<?php

namespace App\Nova\Actions;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Text;

class AcceptServiceFeeForLoan extends Action
{
    use InteractsWithQueue, Queueable;

    protected $loan;
    public $name = 'Xidmət haqqı ödənişini qəbul et';

    public function __construct(Loan $loan)
    {

        $this->loan = $loan;
    }

    public function handle(ActionFields $fields, Collection $models): array
    {
        $model = $models->first();
        $report = $model->loanReports()->first();

        $model->transactions()->create([
            'service_fee' => true,
            'description' => 'Xidmət haqqı ödənişinin qəbulu',
            'price' => $report->service_fee,
            'expected_price' => $report->service_fee,
            'shouldPay' => now(),
            'type' => 'service_fee',
        ]);

        $model->payed_balance += $report->service_fee;
        $model->serviceFeePayed = true;

        $model->saveQuietly();

        return Action::message('Xidmət haqqı ödənişi uğurla qəbul edildi');
    }

    public function fields(): array
    {
        return [
            Currency::make('Xidmət haqqı','service_fee')
                ->withMeta(['value' => @$this->loan->loanReports()->first()->service_fee])
                ->currency('AZN')
                ->readonly(),
            Text::make('Açıqlama', 'description')
                ->readonly()
                ->withMeta(['value' => 'Xidmət haqqı ödənişinin qəbulu'])
        ];
    }

}
