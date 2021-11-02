<?php

namespace App\Rules;

use App\Models\Customer;
use App\Models\Guarantor;
use Illuminate\Contracts\Validation\Rule;

class CheckGuarantorIsRelatedAnyCustomer implements Rule
{
    /**
     * @var Customer
     */
    private $guarantor;
    private $column;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Guarantor $guarantor,$column)
    {

        $this->guarantor = $guarantor;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return !Guarantor::where($attribute, $value)->count();
    }

    public function message(): string
    {
        return 'Vətəndaş digər bir müştəriyə zamin durub.';
    }
}
