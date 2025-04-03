<?php

namespace App\Enum;

use App\Traits\HasEnumOptions;

enum Status: string
{
    use HasEnumOptions;
    case PERMANENT = 'permanent';
    case CASUAL = 'casual';
    case COS_JOP = 'cos/jop';
}
