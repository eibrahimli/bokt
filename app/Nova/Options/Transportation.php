<?php

namespace App\Nova\Options;

use App\Models\Options\CommonResource;

class Transportation extends CommonResource
{
    public static $displayInNavigation = false;
    public static $model = \App\Models\Options\Transportation::class;

    public static function singularLabel(): string
    {
        return 'Nəqliyyat';
    }
    public static function label(): string
    {
        return 'Nəqliyyatlar';
    }
}
