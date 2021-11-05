<?php

namespace App\Rules;

use App\Models\Customer;
use App\Models\Guarantor;
use Illuminate\Contracts\Validation\Rule;

class CheckGuarantorIsRelatedAnyCustomer implements Rule
{

    private $guarantor;
    private $column;

    public function __construct(Guarantor $guarantor,$column)
    {

        $this->guarantor = $guarantor;
        $this->column = $column;
    }

    public function passes($attribute, $value): bool
    {
        return !Guarantor::where($attribute, $value)->count();
    }

    public function message(): string
    {
        return 'Vətəndaş digər bir müştəriyə zamin durub.';
    }
}
