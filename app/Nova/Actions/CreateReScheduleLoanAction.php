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
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class CreateReScheduleLoanAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * @var Loan
     */
    private $loan;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function handle(ActionFields $fields, Collection $models)
    {

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {

        return [
            Text::make('Məhsul')->withMeta(['value' => $this->loan->product->name])->readonly(),
            Currency::make('Qalıq əsas məbləğ')
                ->withMeta(['value' => $this->loan->loanReports()->active()->get()->sum('mainDept')])
                ->currency('AZN'),
            Number::make('Faiz')
                ->readonly()
                ->withMeta(['value' => $this->loan->product->percentage])
        ];
    }
}
