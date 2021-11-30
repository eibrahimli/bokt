<?php

namespace Eibrahimli\CalculationField;

use Laravel\Nova\Fields\Field;

class CalculationField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'calculation-field';

    public function depends(bool $depend = false): CalculationField
    {
        return $this->withMeta(['depends' => $depend]);
    }
}
