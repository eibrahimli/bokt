<?php

namespace App\Nova\Options;

use App\Models\Options\CommonResource;

class Production extends CommonResource
{
    public static $displayInNavigation = true;
    public static $model = \App\Models\Options\Production::class;

    public static function singularLabel(): string
    {
        return 'İstehsal';
    }
    public static function label(): string
    {
        return 'İstehsallar';
    }
}
