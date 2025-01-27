<?php

namespace App\Enum;

use App\Traits\HasEnumOptions;

enum Sex: string
{
    use HasEnumOptions;
    case MALE = 'male';
    case FEMALE = 'female';
}
