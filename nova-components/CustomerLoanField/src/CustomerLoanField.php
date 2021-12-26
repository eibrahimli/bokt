<?php

namespace Eibrahimli\CustomerLoanField;

use Laravel\Nova\Fields\Field;

class CustomerLoanField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'customer-loan-field';

    public function resourceId($id): CustomerLoanField
    {
        return $this->withMeta(['resourceId' => $id]);
    }
}
