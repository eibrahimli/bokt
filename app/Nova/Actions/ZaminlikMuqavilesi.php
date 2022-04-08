<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ZaminlikMuqavilesi extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Zaminlik müqaviləsi';
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //zaminlik-muqavilesi
        $loan = $models->first();
//        dd($loan->customer->guarantors->first()->identity_number);
        $t = new \PhpOffice\PhpWord\TemplateProcessor('word-template/zaminlik-muqavilesi.docx');
        $t->setValue('date', Carbon::now()->format('d/m/Y'));
        $t->setValue('director', $loan->branch->director);
        $t->setValue('ASA', $loan->customer->name
            .' '.$loan->customer->surname
            .' '.$loan->customer->fathername);
        $t->setValue('ID', $loan->id);
        $t->setValue('identity_number', $loan->customer->identity_number);
        $t->setValue('RPS', $loan->customer->indentity_agency);
        $t->setValue('indentity_given_date',Carbon::parse($loan->customer->indentity_given_date)->toDateString());

        $t->setValue('guarantor', $loan->customer->guarantors->first()->name
            .' '.$loan->customer->guarantors->first()->surname
            .' '.$loan->customer->guarantors->first()->fathername);
        $t->setValue('guarantor_identity_number', $loan->customer->guarantors->first()->identity_number);
        $t->setValue('guarantor_identity_given_date', $loan->customer->guarantors->first()->identity_given_date);
        $t->setValue('guarantor_identity_agency', $loan->customer->guarantors->first()->identity_agency);
        $t->setValue('id', $loan->id);
        $t->setValue('percentage', $loan->percentage);
        $t->setValue('price', $loan->price);
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
