<?php

namespace App\Enum;

use App\Traits\HasEnumOptions;

enum EmploymentClassification: string
{
    use HasEnumOptions;
    case TEACHING = 'teaching';
    case NON_TEACHING = 'non teaching';
}
