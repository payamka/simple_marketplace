<?php

namespace App\Enums;

enum ResponseCodesEnum: int
{
    case RESPONSE_SUCCESSFUL = 100;
    case RESPONSE_FAILURE = -1;
}
