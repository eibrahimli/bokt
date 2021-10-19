<?php

namespace App\Nova;
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

    public static $model = \App\Models\Common::class;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $group = 'Seçimlər';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
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
