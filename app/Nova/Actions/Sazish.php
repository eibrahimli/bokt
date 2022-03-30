<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Sazish extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'SAZİŞ';
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //sazish-yeni-girov-mugavilesi
        $loan = $models->first();
        $t = new \PhpOffice\PhpWord\TemplateProcessor('word-template/sazish-yeni-girov-mugavilesi-1.docx');
        $t->setValue('date', Carbon::now()->format('d/m/Y'));
        $t->setValue('ID', $loan->id);
        $file = $loan->id;
        $t->setValue('ASA', $loan->customer->name
            .' '.$loan->customer->surname
            .' '.$loan->customer->fathername);
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
