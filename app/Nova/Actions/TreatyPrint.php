<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Helpers\LoanHelper;

class TreatyPrint extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Expres kredit müqaviləsi';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $loan = $models->first();
        $numberToWords = new \NumberFormatter('az',\NumberFormatter::SPELLOUT );
//        dd($loan->product->name);
        $t = new \PhpOffice\PhpWord\TemplateProcessor('word-template/express-kredit-mugavilesi-1.docx');
        $t->setValue('date', Carbon::now()->format('d/m/Y'));
        $t->setValue('ID', $loan->id);
        $t->setValue('ASA', $loan->customer->name
            .' '.$loan->customer->surname
            .' '.$loan->customer->fathername);
        $t->setValue('fin', $loan->customer->fin);
        $t->setValue('FIFD', LoanHelper::findFifd($loan));
        $t->setValue('whole_payable_balance', $loan->whole_payable_balance);
        $t->setValue('price', $loan->price);
        $t->setValue('price_to_word', $numberToWords->format($loan->price));
        $t->setValue('month', $loan->month);
        $t->setValue('percentage', $loan->percentage);
        $t->setValue('firstMouth', $loan->loanReports->first()->shouldPay);
        $t->setValue('lastMouth', $loan->loanReports->last()->shouldPay);
        $t->setValue('service_fee_percent', $loan->product->service_fee);
        $t->setValue('service_fee_value', $loan->loanReports->first()->service_fee);
        $t->setValue('product_name', $loan->product->name);
        $t->setValue('director', $loan->branch->director);
        $file = $loan->id;
        $t->saveAs($file.'.docx');

        return Action::download(asset($file.'.docx'), $file.'.docx');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
