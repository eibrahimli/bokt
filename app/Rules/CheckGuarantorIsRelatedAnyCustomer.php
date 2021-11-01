<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class CheckGuarantorIsRelatedAnyCustomer implements Rule
{
    /**
     * @var Customer
     */
    private $customer;
    private $column;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Customer $customer,$column)
    {

        $this->customer = $customer;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->customer->guarantors->filter(function ($guarantor) use($attribute,$value) {
            if($guarantor->$attribute == $value) {
                return false;
            }
            return true;
        });
    }

    public function message(): string
    {
        return 'Vətəndaş digər bir müştəriyə zamin durub.';
    }
}
