<?php

namespace App\Nova\Options;

use App\Nova\CommonResource;

class Consumption extends CommonResource
{
    public static $displayInNavigation = true;

    public static $model = \App\Models\Options\Consumption::class;

    public static function singularLabel(): string
    {
        return 'İstehlak';
    }
    public static function label(): string
    {
        return 'İstehlaklar';
    }
}
