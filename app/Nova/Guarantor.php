<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Eibrahimli\ContactPhonesFields\ContactPhonesFields;
use Eibrahimli\HiddenField\HiddenField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Guarantor extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Guarantor::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $displayInNavigation = false;

    public static function label() :string
    {
        return 'Zaminlər';
    }

    public static function singularLabel(): string
    {
        return 'Zamin';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name','surname', 'fathername', 'fin'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("Ad", 'name')->sortable(),
            Text::make('Soyad','surname')->sortable(),
            Text::make('Ata Adı', 'fathername')->sortable(),
            Text::make('Fin', 'fin')->sortable()->rules(['nullable', 'string', 'size:7']),
            Text::make('Ş.V. Seriya №', 'identity_number')->sortable(),
            Textarea::make('Qeydiyyat ünvanı','registration_address')->hideFromIndex(),
            Textarea::make('Yaşayış ünvanı','residential_address')->hideFromIndex(),
            Files::make('Əlavələr','main')->hideFromIndex(),
            ContactPhonesFields::make('Əlaqə telefonu', 'contact_phone'),
            HiddenField::make('', 'contact_phone_1'),
            HiddenField::make('', 'contact_phone_2'),
            HiddenField::make('', 'contact_phone_3'),
            Date::make('Doğum tarixi','date_of_birth'),
            Text::make('Doğum yeri','birthplace'),
            BelongsTo::make('Müştəri','customer', Customer::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
