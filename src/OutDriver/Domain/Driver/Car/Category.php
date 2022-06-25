<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

enum Category: string
{
    case M = 'M';
    case A = 'A';
    case B = 'B';
    case BE = 'BE';
    case C = 'C';
    case CE = 'CE';
    case D = 'D';
    case DE = 'DE';
    case TM = 'TM';
    case TB = 'TB';

    /** Subcategory: */
    case A1 = 'A1';
    case B1 = 'B1';
    case C1 = 'C1';
    case C1E = 'C1E';
    case D1 = 'D1';
    case D1E = 'D1E';
}