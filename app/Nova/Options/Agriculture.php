<?php

namespace App\Nova\Options;

use App\Nova\CommonResource;

class Agriculture extends CommonResource
{

    public static $model = \App\Models\Options\Agriculture::class;

    public static function singularLabel(): string
    {
        return 'Kənd təsərrüfatı';
    }
    public static function label(): string
    {
        return 'Kənd təsərrüfatları';
    }
}
