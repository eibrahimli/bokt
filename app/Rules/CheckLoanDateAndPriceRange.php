<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckLoanDateAndPriceRange implements Rule
{
    private $product;
    /**
     * @var string
     */
    private $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($product, $type='price')
    {
        $this->product = $product;
        $this->type = $type;
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
        if($attribute == 'month'):
            return $this->product->min_date <= $value && $this->product->max_date >= $value;
        elseif($attribute === 'price'):
            return $this->product->min_price <= $value && $this->product->max_price >= $value;
        endif;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        if($this->type == 'month'):
            return 'Kreditin ay aralığı '. $this->product->min_date. ' və '.$this->product->max_date.' olmalıdır';
        endif;

        return 'Kreditin məbləğ aralığı '. $this->product->min_price. ' və '.$this->product->max_price.' olmalıdır';
    }
}
