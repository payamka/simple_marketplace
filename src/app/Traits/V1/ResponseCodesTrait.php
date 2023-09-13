<?php

namespace App\Traits\V1;

trait ResponseCodesTrait
{
    protected static $RESPONSE_FAIL = -1;
    protected static $RESPONSE_OK = 100;
    protected static $RESPONSE_NOT_AUTHORIZED = 99;
}
