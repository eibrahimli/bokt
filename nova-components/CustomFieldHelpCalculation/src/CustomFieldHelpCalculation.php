<?php

namespace Eibrahimli\CustomFieldHelpCalculation;

use Laravel\Nova\Fields\Field;

class CustomFieldHelpCalculation extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'custom-field-help-calculation';

    public function tax($boolean=false): CustomFieldHelpCalculation
    {
        return $this->withMeta([
            'tax' => $boolean
        ]);
    }
}
