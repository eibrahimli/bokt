<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    public static $model = \App\Models\User::class;
    public static $title = 'name';
    public static $displayInNavigation = false;

    public static function singularLabel(): string
    {
        return 'İstifadəçi';
    }

    public static function label(): string
    {
        return 'İstifadəçilər';
    }

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Gravatar::make()->maxWidth(50),

            Text::make('Ad','name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Soyad','surname')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Select::make("Vəzifə",'role')->options([
                'admin' => 'Admin',
                'supervisor' => 'Əməliyyatçı',
                'cashier' => 'Kassir',
                'kreditor' => 'Kreditor'
            ])->rules('required'),

            Password::make('Şifrə', 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            BelongsTo::make('Filial', 'branch', \App\Nova\Branch::class)->showCreateRelationButton(),
            BelongsTo::make('İstifadəçi qrupu','group',UserGroup::class)->showCreateRelationButton()
        ];
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
