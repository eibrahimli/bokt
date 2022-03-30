<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class YeniQirovMuqavilesi extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Yeni Girov Müqaviləsi";

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
        $t = new \PhpOffice\PhpWord\TemplateProcessor('word-template/yeni-qirov-muqavilesi.docx');
        $t->setValue('date', Carbon::now()->format('d/m/Y'));
        $t->setValue('ID', $loan->id);
        $t->setValue('director', $loan->branch->director);
        $t->setValue('ASA', $loan->customer->name
            .' '.$loan->customer->surname
            .' '.$loan->customer->fathername);
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
