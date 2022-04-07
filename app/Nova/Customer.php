<?php

namespace App\Nova;

use App\Nova\Actions\ExportPDF;
use App\Nova\Filters\BranchFilter;
use App\Nova\Filters\CreatedAtCustomerEnd;
use App\Nova\Filters\CreatedAtCustomerStart;
use App\Nova\Filters\CustomerHasPenalty;
use App\Nova\Metrics\ModelPerDay;
use App\Nova\Metrics\NewCustomer;
use App\Nova\Options\AdminUnit;
use App\Nova\Options\LegalStatus;
use Coroowicaksono\ChartJsIntegration\DoughnutChart;
use Coroowicaksono\ChartJsIntegration\PolarAreaChart;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use KirschbaumDevelopment\NovaChartjs\Traits\HasChart;
use KossShtukert\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Eibrahimli\HiddenField\HiddenField;
use Eibrahimli\ContactPhonesFields\ContactPhonesFields;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NrmlCo\NovaBigFilter\NovaBigFilter;

class Customer extends Resource
{
    use HasChart;
    public static $model = \App\Models\Customer::class;

    public static $title = 'title';
    public static $displayInNavigation = false;

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
            Select2::make('Kreditor','kredit_id')->options(\App\Models\User::where('role', 'kreditor')->pluck('name', 'id')->toArray()),
            BelongsTo::make('İqtisadi rayon','adminUnit', AdminUnit::class)->showCreateRelationButton()->nullable(),
            BelongsTo::make('Hüquqi status','legalStatus', LegalStatus::class)->showCreateRelationButton()->nullable(),
            NovaDependencyContainer::make([
               Number::make('Voen', 'voen')->rules(['required'])
            ])
                ->dependsOn('legalStatus.id', 1)
                ->dependsOn('legalStatus.id', 2),
            Text::make("Ad", 'name')->rules(['required'])->sortable(),
            Text::make("Vəsiqənin verildiyi orqan", 'indentity_agency')->rules(['required'])->sortable(),
            Date::make("Vəsiqənin verildiyi tarix", 'intentity_given_date')->rules(['required'])->sortable(),
            NovaDependencyContainer::make([
                Text::make('Soyad','surname')->showOnIndex()->sortable(),
                Text::make('Ata Adı', 'fathername')->showOnIndex()->sortable(),
                Text::make('Fin', 'fin')->sortable()->rules(['required', 'string', 'size:7']),
                Text::make('Ş.V. Seriya №', 'identity_number')->sortable(),
            ])->dependsOnNot('legalStatus.id',1)->showOnIndex(),
            Textarea::make('Qeydiyyat ünvanı','registration_address')->hideFromIndex(),
            Textarea::make('Yaşayış ünvanı','residential_address')->hideFromIndex(),
            Select::make('Cins','gender')->options([
                'male' => 'Kişi',
                'female' => 'Qadın'
            ])->displayUsing(function () { return $this->maritial_status == 'female' ? 'Qadın' : 'Kişi'; }),
            Text::make("Həyat Yoladşı Ad", 'wife_name')->rules(['required'])->sortable(),
            Text::make('Həyat Yoldaşı Soyad','wife_surname')->showOnIndex()->sortable(),
            Text::make('Həyat Yoladşı Ata Adı', 'wife_fathername')->showOnIndex()->sortable(),
            HiddenField::make('', 'contact_phone_1'),
            HiddenField::make('', 'contact_phone_2'),
            HiddenField::make('', 'contact_phone_3'),
            ContactPhonesFields::make('Əlaqə telefonu', 'contact_phone'),
            Boolean::make('Məcburi köçkün', 'is_immigrant')->sortable()->hideFromIndex(),
            Select::make('Ailə vəziyyəti','maritial_status')->options([
                'married' => 'Evli',
                'single' => 'Subay'
            ])
                ->hideFromIndex()
                ->displayUsing(function () { return $this->maritial_status == 'married' ? 'Evli' : 'Subay'; })
                ->rules(['required'])
            ,
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
            new NovaBigFilter()
        ];
    }


    public function filters(Request $request) :array
    {
        return [
            new CreatedAtCustomerStart(),
            new CreatedAtCustomerEnd(),
            new BranchFilter(),
            new CustomerHasPenalty(),
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
