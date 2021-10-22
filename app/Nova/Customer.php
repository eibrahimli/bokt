<?php

namespace App\Nova;

use App\Nova\Actions\ExportPDF;
use App\Nova\Metrics\ModelPerDay;
use App\Nova\Metrics\NewCustomer;
use Coroowicaksono\ChartJsIntegration\DoughnutChart;
use Coroowicaksono\ChartJsIntegration\PolarAreaChart;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Http\Request;
use KirschbaumDevelopment\NovaChartjs\Contracts\Chartable;
use KirschbaumDevelopment\NovaChartjs\InlinePanel;
use KirschbaumDevelopment\NovaChartjs\Traits\HasChart;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Eibrahimli\HiddenField\HiddenField;
use Eibrahimli\ContactPhonesFields\ContactPhonesFields;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use OptimistDigital\NovaInputFilter\InputFilter;
use Yassi\NestedForm\NestedForm;

class Customer extends Resource
{
    use HasChart;
    public static $model = \App\Models\Customer::class;

    public static $title = 'title';
    public static $displayInNavigation = false;

    public static $search = [
        'id','name', 'surname', 'fathername','fin'
    ];

    public static function indexQuery(NovaRequest $request, $query): \Illuminate\Database\Eloquent\Builder
    {

        return parent::indexQuery($request, $query); // TODO: Change the autogenerated stub
    }

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
            ])->displayUsing(function () { return $this->maritial_status == 'female' ? 'Qadın' : 'Kişi'; }),
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
            HasMany::make('Zaminlər','guarantors', Guarantor::class),
            HasMany::make('Kreditlər', 'loans', Loan::class),
            DateTime::make('Əlavə Edilmə tarixi','created_at')->onlyOnIndex(),
        ];
    }


    public function cards(Request $request) :array
    {
        return [

            new NewCustomer(null,$this),
            new ModelPerDay(null,$this,'Aylıq statistika'),
            (new DoughnutChart())
                ->title('Müştərilər')
                ->series(array([
                    'data' => [10, 10, 10, 10, 10, 10, 10, 10],
                    'backgroundColor' => ["#ffcc5c","#91e8e1","#ff6f69","#88d8b0","#b088d8","#d8b088", "#88b0d8", "#6f69ff"],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => ['Portion 1','Portion 2','Portion 3','Portion 4','Portion 5','Portion 6','Portion 7','Portion 8']
                    ],
                ]),
            (new PolarAreaChart())
                ->title('Müştərilər Statistika')
                ->series(array([
                    'data' => [170, 180, 130, 190, 121, 90, 180, 110],
                    'backgroundColor' => ["#ffcc5c","#91e8e1","#ff6f69","#88d8b0","#b088d8","#d8b088", "#88b0d8", "#6f69ff"],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => ['Portion 1','Portion 2','Portion 3','Portion 4','Portion 5','Portion 6','Portion 7','Portion 8']
                    ],
                ]),
            (new StackedChart())
                ->title('Müştərilər')
                ->model('\App\Models\Customer'),
            new NovaBigFilter(),
        ];
    }


    public function filters(Request $request) :array
    {
        return [

        ];
    }


    public function lenses(Request $request) :array
    {
        return [];
    }


    public function actions(Request $request) :array
    {
        return [
            (new DownloadExcel())->withFilename('Müştərilər'.time().'xlsx')->withHeadings()->allFields(),
            ExportPDF::make()
        ];
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
