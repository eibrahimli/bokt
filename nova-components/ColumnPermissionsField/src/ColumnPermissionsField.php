<?php

namespace Eibrahimli\ColumnPermissionsField;

use App\Permissions\ColumnPermission;
use Laravel\Nova\Fields\Field;

class ColumnPermissionsField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'column-permissions-field';

    /**
     * Function to set available columns
     *
     * @param ColumnPermission[] $options
     *
     * @return $this
    */
    public function options(array $options): ColumnPermissionsField {

      return $this->withMeta([
        'options' => array_map(function (ColumnPermission $o) { return $o->toArray(); }, $options),
      ]);
    }
}
