<?php

namespace App\Nova\Actions;

use App\Models\Interfaces\HTMLExportable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ExportPDF extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Export PDF';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models[0] ?? null;
        if (!$model) {
            return Action::danger('Heç nə seçilməyib');
        }
        return Action::download(
            "/letters/{$model->id}.pdf",
            "Hesabat #{$model->id}.pdf"
        );
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
