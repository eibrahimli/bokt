<?php

namespace App\Nova\Options;

use App\Models\Options\CommonResource;

class Service extends CommonResource
{
    public static $displayInNavigation= true;
    public static $model = \App\Models\Options\Service::class;

    public static $group = 'Seçimlər';
    public static $subGroup = 'Seçimlər';

    public static function singularLabel(): string
    {
        return 'Xidmət';
    }
    public static function label(): string
    {
        return 'Xidmətlər';
    }
}
