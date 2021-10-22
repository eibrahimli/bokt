<?php

namespace App\Nova\Options;

use App\Models\Options\CommonResource;

class Trade extends CommonResource
{
    public static $displayInNavigation = true;
    public static $model = \App\Models\Options\Trade::class;

    public static function singularLabel(): string
    {
        return 'Ticarət';
    }
    public static function label(): string
    {
        return 'Ticarətlər';
    }
}
