<?php

namespace Eibrahimli\EdvTool;

use Laravel\Nova\ResourceTool;

class EdvTool extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Edv Tool';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'edv-tool';
    }
}
