<?php

namespace App\Nova\Options;

use App\Nova\CommonResource;

class Service extends CommonResource
{

    public static $model = \App\Models\Options\Service::class;

    public static function singularLabel(): string
    {
        return 'Xidmət';
    }
    public static function label(): string
    {
        return 'Xidmətlər';
    }
}
