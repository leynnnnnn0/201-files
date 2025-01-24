<?php

namespace App\Enum;

enum Status: string
{
    case PERMANENT = 'permanent';
    case CASUAL = 'casual';
    case COS_JOP = 'contract of service / job order personnel';
}
