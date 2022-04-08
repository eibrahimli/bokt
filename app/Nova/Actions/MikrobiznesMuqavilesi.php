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

class MikrobiznesMuqavilesi extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Mikrobiznes müqavilə';
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //mikrobiznes-muqavilesi
        $loan = $models->first();
        $numberToWords = new \NumberFormatter('az',\NumberFormatter::SPELLOUT );
        $t = new \PhpOffice\PhpWord\TemplateProcessor('word-template/mikrobiznes-muqavilesi.docx');
        $t->setValue('date', Carbon::now()->format('d/m/Y'));
        $t->setValue('ASA', $loan->customer->name
            .' '.$loan->customer->surname
            .' '.$loan->customer->fathername);
        $t->setValue('director', $loan->branch->director);
        $t->setValue('identity_number', $loan->customer->identity_number);
        $t->setValue('RPS', $loan->customer->indentity_agency);
        $t->setValue('indentity_given_date',Carbon::parse($loan->customer->indentity_given_date)->toDateString());
        $t->setValue('price', $loan->price);
        $t->setValue('price_to_word', $numberToWords->format($loan->price));
        $t->setValue('month', $loan->month);
        $t->setValue('percentage', $loan->percentage);
        $t->setValue('FIFD', LoanHelper::findFifd($loan));
        $t->setValue('firstMouth', $loan->loanReports->first()->shouldPay);
        $t->setValue('lastMouth', $loan->loanReports->last()->shouldPay);
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
