<?php

namespace App\Nova\Options;

use App\Models\Options\CommonResource;

class Trick extends CommonResource
{
    public static $displayInNavigation = false;
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
