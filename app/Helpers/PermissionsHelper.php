<?php


namespace App\Helpers;

use App\Models\User;
use App\Permissions\ColumnPermission;
use Laravel\Nova\Fields\Field;

/**
 * Class to help in RBAC implementation
 */
class PermissionsHelper
{
    /**
     * Variable to store all permissions in compact form
     *
     * @var array
     */
    protected static $permissions = [];

    protected static $availableFields = null;

    /**
     * Method to get menu items options
     *
     * @return array
     */

    public static function getUriKeysWithPermissionColumn() :array {
        return [
            'new' => [
                'oral-requests' => 'new_oral_requests',
                'question-requests' => 'new_question_requests',
                'redirect-requests' => 'new_redirect_requests',
                'basic-requests' => 'new_request_basics',
                'event-requests' => 'new_request_events',
                'enlightenment-requests' => 'new_request_enlightens',
                'meetings' => 'new_request_meetings',
                'visit-requests' => 'new_request_visits',
                'project-requests' => 'new_request_projects',
                'investments' => 'new_request_investments'
            ],
            'all' => [
                'oral-requests' => 'my_oral_requests',
                'question-requests' => 'my_question_requests',
                'redirect-requests' => 'my_redirect_requests',
                'basic-requests' => 'my_basics',
                'event-requests' => 'my_events',
                'enlightenment-requests' => 'my_enlightens',
                'meetings' => 'my_meetings',
                'visit-requests' => 'my_visit_applications',
                'project-requests' => 'my_projects',
                'investments' => 'my_investments'
            ]
        ];
    }

    public static function getMenuOptions(): array
    {
        return [
            'new_loans' => new ColumnPermission("new_loans", "Yeni Kredit"),
            'new_customers' => new ColumnPermission("new_customers", "Yeni Müştəri"),
            'new_guarantors' => new ColumnPermission("new_guarantors", "Yeni Zamin"),
            'new_products' => new ColumnPermission("new_products", "Yeni Məhsul"),
            'new_users' => new ColumnPermission("new_users", "Yeni İstifadəçi"),
            'new_user-groups' => new ColumnPermission("new_user-groups", "Yeni İstifadəçi Qrupu"),
            'new_transactions' => new ColumnPermission("new_transactions", "Yeni Tranzaksiya"),
            'new_branch' => new ColumnPermission("new_branch", "Yeni Filial"),

            'loans' => new ColumnPermission("loans", "Kreditlər"),
            'customers' => new ColumnPermission("customers", "Müştərilər"),
            'guarantors' => new ColumnPermission("guarantors", "Zaminlər"),
            'users' => new ColumnPermission("users", "İstifadəçilər"),
            'products' => new ColumnPermission("products", "Məhsullar"),
            'user-groups' => new ColumnPermission("user-groups", "İstifadəçi Qrupları"),
            'transactions' => new ColumnPermission("transactions", "Tranzaksiyalar"),
            'branchs' => new ColumnPermission("branchs", "Filiallar"),
        ];
    }


    /**
     * Method to get all available fields to regulate
     *
     * @return ColumnPermission[]
     */
    public static function getAvailableFields(): array
    {
        if (!static::$availableFields) {
            static::$availableFields = array_merge(
                static::getMenuOptions(),
            );
        }

        return static::$availableFields;
    }

    /**
     * Calculate permissions for user
     *
     * @param User $user
     * @param string $column
     *
     * @return array
     */
    protected static function calculatePermissions(User $user, string $column): array
    {

        if ($user->group) {

            $value = $user->group->{$column};

            return is_array($value) ? $value : json_decode($value, true) ?? [];
        } else {
            return [];
        }
    }

    public static function setupField(User $user, Field $field, $path): Field
    {
        $attribute = $field->attribute;

        $column = static::getColumn($attribute, $path);

        if (!$attribute || !$column) {
            return $field;
        }

        $permissions = static::$permissions[$user->id];

        if (!key_exists($attribute, $permissions) || $permissions[$attribute] == 'default') {
            // Return default option

            return $field->withMeta(['name' => $column->getDefault()]);
        }


        $permission_atribute_value = explode('||', $permissions[$attribute]);

        if (count($permission_atribute_value) > 1):
            $permission = $permission_atribute_value[1];
            if ($path == $permission_atribute_value[0]):
                if($permission == 'default' || $permission == 's'):
                    if($permission == 's') {
                        $field->name = $permission_atribute_value[2];
                        return $field;
                    }
                    return $field;
                endif;
                return $field->$permission();
            endif;
        endif;

        // If not, disable field
        if (!$permissions[$attribute] && !in_array($permissions[$attribute], ['hideWhenCreating', 'hideWhenUpdating'])) {
            return $field->canSeeWhen('disable');
        }

        if (in_array($permissions[$attribute], ['hideWhenUpdating', 'hideWhenCreating'])) {

            if ($permissions[$attribute] == 'hideWhenUpdating'):
                return $field->hideWhenUpdating();
            else:
                return $field->hideWhenCreating();
            endif;
        }

        // Otherwise get name of field and return
        return $field->withMeta([
            'name' => $column->getName($permissions[$attribute]),
        ]);
    }

    /**
     * Method to check whether user can or can't see the field
     *
     * @param User $user
     * @param string $field
     * @param string $column
     *
     * @return bool
     */
    public static function checkPermission(User $user, string $field, string $column = 'columnsList'): bool
    {

        if (!$field || !key_exists($field, static::getAvailableFields())) {
            return true;
        }

        static::$permissions[$user->id] = static::calculatePermissions($user, $column);

        return !key_exists($field, static::$permissions[$user->id]) || (static::$permissions[$user->id][$field] ?? false);
    }

    /**
     * Method to check the state of key
     *
     * @param User $user
     * @param string $field
     * @param string $column
     *
     * @return string
     */
    public static function getPermissionState(User $user, string $field, string $column = 'columnsList'): ?string
    {
//    return true;

        if (!$field || !key_exists($field, static::getAvailableFields())) {
            return null;
        }

        if (!isset(static::$permissions[$user->id])) {
            static::$permissions[$user->id] = static::calculatePermissions($user, $column);
        }

        return static::$permissions[$user->id][$field] ?? null;
    }


    public static function getColumnValue(User $user, $column) {
        if($user->group) {

            $value = $user->group->{$column};

            return is_array($value) ? $value : json_decode($value, true) ?? [];
        }

        return [];
    }

}
