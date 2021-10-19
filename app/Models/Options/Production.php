<?php

namespace App\Models\Options;

use App\Models\Common;

class Production extends Common
{
    protected $table = 'productions';
    protected $requestKeyName = 'production_id';
}
