<?php

namespace App;

use App\Traits\HasEnumOptions;

enum OfficesColleges: string
{
    use HasEnumOptions;
    case ATBI = 'ATBI';
    case BAKERY = 'BAKERY';
    case CA = 'CA';
    case CAH = 'CAH';
    case CANTEEN = 'CANTEEN';
    case CCARD = 'CCARD';
    case CE = 'CE';
    case CF = 'CF';
    case CHET = 'CHET';
    case CHET_SP = 'CHET SP';
    case CHK = 'CHK';
    case CIS = 'CIS';
    case CM = 'CM';
    case CN = 'CN';
    case CNAS = 'CNAS';
    case CNS = 'CNS';
    case COARDC = 'COARDC';
    case CORCAARD = 'CORCAARD';
    case CPAG = 'CPAG';
    case CRAC = 'CRAC';
    case CSAC = 'CSAC';
    case CSRWD = 'CSRWD';
    case CSS = 'CSS';
    case CTE = 'CTE';
    case CVM = 'CVM';
    case ECDC = 'ECDC';
    case FPC = 'FPC';
    case FSRIC = 'FSRIC';
    case GARMENTS = 'GARMENTS';
    case GIS = 'GIS';
    case GLADIOLA = 'GLADIOLA';
    case GSO = 'GSO';
    case GUESTELS = 'GUESTELS';
    case HERRC = 'HERRC';
    case HORTI = 'HORTI';
    case HRDO = 'HRDO';
    case HRMO = 'HRMO';
    case ICT = 'ICT';
    case IFHSA = 'IFHSA';
    case ILC = 'ILC';
    case ISRD = 'ISRD';
    case LANDSCAPING = 'LANDSCAPING';
    case MARKETING = 'MARKETING';
    case NPRCRTC = 'NPRCRTC';
    case NSTP = 'NSTP';
    case OES = 'OES';
    case OP = 'OP';
    case ORS = 'ORS';
    case OSS = 'OSSw';
    case OU = 'OU';
    case OUR = 'OUR';
    case OVPAA = 'OVPAA';
}
