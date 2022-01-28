<?php

namespace App\Rules;

use App\Models\LoanReport;
use Illuminate\Contracts\Validation\Rule;

class CheckTransactionPaymentIsGreaterThanExpectedPrice implements Rule
{
    /**
     * @var LoanReport
     */
    private $report;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($report)
    {

        $this->report = $report;
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
        if($this->report->percentage_remainder > 0) {
            return $value >= $this->report->totalDept - $this->report->percentage_remainder;
        }
        return $value >= $this->report->totalDept;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ödəniş məbləği kredit məbləğindən çox və bərabər olmalıdır.';
    }
}