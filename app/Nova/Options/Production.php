<?php

namespace App\Nova\Options;

use App\Nova\CommonResource;

class Production extends CommonResource
{

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
