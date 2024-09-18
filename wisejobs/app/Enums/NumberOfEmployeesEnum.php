<?php

namespace App\Enums;

enum NumberOfEmployeesEnum: string {
    case SMALL = '1 to 50';
    case MEDIUM = '51 to 200';
    case LARGE = '201 to 500';
    case CORPORATION = '500+';
}