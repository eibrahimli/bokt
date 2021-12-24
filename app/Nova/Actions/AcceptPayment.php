<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class AcceptPayment extends Action
{
    public $showOnTableRow = true;
    use InteractsWithQueue, Queueable;

//    public $component = 'test-action';

    public function handle(ActionFields $fields, Collection $models)
    {
        //
    }


    public function fieldos(): array
    {
        return [];
    }

    public function name(): string
    {
        return "Ödəniş qəbul et"; // TODO: Change the autogenerated stub
    }
}
