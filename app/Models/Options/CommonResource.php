<?php

namespace App\Models\Options;
use App\Models\Loan;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use SaintSystems\Nova\ResourceGroupMenu\DisplaysInResourceGroupMenu;

class CommonResource extends \App\Nova\Resource
{
    use DisplaysInResourceGroupMenu;

    public static $displayInNavigation = false;
    public static $title = 'name';

    public static $group = 'Seçimlər';

    public static $subGroup = 'Seçimlər';

    public static $search = [
        'id', 'name'
    ];

    public static function singularLabel(): string
    {
        return self::label();
    }

    public function fields(Request $request): array
    {
        return array_merge([
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Ad', 'name'),
            HasMany::make('Kreditlər', 'loans', \App\Nova\Loan::class)
        ], $this->additionalFields());
    }

    protected function additionalFields(): array
    {
        return [];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [];
    }

}
