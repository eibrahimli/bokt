<?php

namespace App\Nova\Options;

use App\Nova\CommonResource;

class Trick extends CommonResource
{

    public static $model = \App\Models\Options\Trick::class;

    public static function singularLabel(): string
    {
        return 'Əyyar';
    }
    public static function label(): string
    {
        return 'Əyyarlar';
    }
}
