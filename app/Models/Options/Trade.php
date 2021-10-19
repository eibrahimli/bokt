<?php

namespace App\Models\Options;

use App\Models\Common;

class Trade extends Common
{
    protected $table = 'trades';
    protected $requestKeyName = 'trade_id';
}
