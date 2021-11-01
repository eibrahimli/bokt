<?php


namespace App\Composers;


use App\Helpers\PermissionsHelper;
use App\Nova\Branch;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NavigationComposer
{
    protected $shortcuts;
    protected $groups;
    protected $links;
    protected $additionalResources;

    public function __construct()
    {
        $user = Auth::user();
        $checkPermissionsCallback = function ($type) use ($user){

            return !is_string($type) ||
                ($user && PermissionsHelper::checkPermission($user, $type, 'menu_items'));
        };

//        $this->shortcuts = array_filter($this->shortcuts, $checkPermissionsCallback, ARRAY_FILTER_USE_KEY);

        $this->groups = [
            'customers' => \App\Nova\Customer::class,
            'transactions' => \App\Nova\Transaction::class,
            'loans' => \App\Nova\Loan::class,
            'products' => \App\Nova\Product::class,
            'guarantors' => \App\Nova\Guarantor::class,
            'users' => \App\Nova\User::class,
            'user-groups' => \App\Nova\UserGroup::class,
            'branchs' => Branch::class,
        ];

        $this->groups = array_filter($this->groups, $checkPermissionsCallback, ARRAY_FILTER_USE_KEY);

    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
//        $view->with('documentShortcuts', $this->shortcuts);
        $view->with('documentGroups', $this->groups);
    }
}
