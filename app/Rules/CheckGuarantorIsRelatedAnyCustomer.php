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
        $query = Guarantor::query()->where($attribute, $value);
        if(@$this->guarantor->customer->id) {
            $query->where('customer_id', '!=', $this->guarantor->customer->id);
        }

        return !$query->count();
    }

    public function message(): string
    {
        return 'Vətəndaş digər bir müştəriyə jhsdj('.$this->gurantor->customer->name.' '.$this->guarantor->customer->surname.') zamin durub.';
    }
}
