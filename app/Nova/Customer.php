<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Ebess\AdvancedNovaMediaLibrary\Fields\Media;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Eibrahimli\HiddenField\HiddenField;
use Eibrahimli\ContactPhonesFields\ContactPhonesFields;
use Yassi\NestedForm\NestedForm;

class Customer extends Resource
{

    public static $model = \App\Models\Customer::class;

    public static $title = 'id';

    public static $search = [
        'id','name', 'surname', 'fathername','fin'
    ];

    public static function label(): string
    {
        return "Müştərilər";
    }

    public static function singularLabel(): string
    {
        return 'Müştəri';
    }

    public function fields(Request $request) :array
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
            Select::make('Cins','gender')->options([
                'male' => 'Kişi',
                'female' => 'Qadın'
            ]),
            HiddenField::make('', 'contact_phone_1'),
            HiddenField::make('', 'contact_phone_2'),
            HiddenField::make('', 'contact_phone_3'),
            ContactPhonesFields::make('Əlaqə telefonu', 'contact_phone'),
            Boolean::make('Məcburi köçkün', 'is_immigrant')->sortable()->hideFromIndex(),
            Select::make('Ailə vəziyyəti','maritial_status')->options([
                'married' => 'Evli',
                'single' => 'Subay'
            ])->hideFromIndex()->displayUsing(function () { return $this->maritial_status == 'married' ? 'Evli' : 'Subay'; }),
            Files::make('Əlavələr','main')->hideFromIndex(),
            Date::make('Doğum tarixi','date_of_birth'),
            Text::make('Doğum yeri','birthplace'),
            NestedForm::make('Zaminlər','guarantors', Guarantor::class),
            HasMany::make('Zaminlər','guarantors', Guarantor::class),
            HasMany::make('Kreditlər', 'loans', Loan::class),
        ];
    }


    public function cards(Request $request) :array
    {
        return [];
    }


    public function filters(Request $request) :array
    {
        return [];
    }


    public function lenses(Request $request) :array
    {
        return [];
    }


    public function actions(Request $request) :array
    {
        return [];
    }

    private function contactFields() :array {
        return [
            HiddenField::make('', 'contact_phone_1'),
            HiddenField::make('', 'contact_phone_2'),
            HiddenField::make('', 'contact_phone_3'),
            ContactPhonesFields::make('Əlaqə telefonu', 'contact_phone')
        ];
    }
}
