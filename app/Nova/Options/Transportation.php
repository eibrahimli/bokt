<?php

namespace App\Nova\Options;

use App\Nova\CommonResource;

class Transportation extends CommonResource
{

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
