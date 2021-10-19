<?php

namespace App\Models\Options;

use App\Models\Common;

class Consumption extends Common
{
    protected $table = 'consumptions';
    protected $requestKeyName = 'consumption_id';
}
