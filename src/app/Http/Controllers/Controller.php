<?php

namespace App\Http\Controllers;

use App\Traits\V1\ResponseCodesTrait;
use App\Traits\V1\ResponseGeneratorTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseGeneratorTrait, ResponseCodesTrait;
}
