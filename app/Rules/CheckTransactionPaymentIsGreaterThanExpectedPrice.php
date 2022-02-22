<?php

namespace App\Rules;

use App\Models\LoanReport;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckTransactionPaymentIsGreaterThanExpectedPrice implements Rule
{
    /**
     * @var LoanReport
     */
    public $report;

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
    public function passes($attribute, $value): bool
    {
        if(Carbon::parse($this->report->shouldPay) > now()):
            return $value >= $this->report->penalty;
        else:
            return $value > 0;
        endif;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Ödəniş məbləği ən azı cərimədən böyük olmalıdı';
    }
}
