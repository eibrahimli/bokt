<?php

namespace App\Models\Options;

use App\Models\Common;

class Trick extends Common
{
    protected $table = 'tricks';
    protected $requestKeyName = 'trick_id';
}
