<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SazishYeniGirovMuqavilesi extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'SAZİŞ - Yeni Girov Müqaviləsinə əlavə';
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
        $t = new \PhpOffice\PhpWord\TemplateProcessor('word-template/sazish-yeni-girov-mugavilesi.docx');
        $t->setValue('date', Carbon::now()->format('d/m/Y'));
        $file = $loan->id;
        $t->saveAs($file.'.docx');
        return response()->download($file.'.docx')->deleteFileAfterSend(false);
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
