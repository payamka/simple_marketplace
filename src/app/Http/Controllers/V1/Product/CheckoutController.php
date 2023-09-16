<?php

namespace App\Http\Controllers\V1\Product;

use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\iProductService;

class CheckoutController extends Controller
{
    public function __construct(private readonly iProductService $produce_service)
    {
    }

    public function store(Request $request)
    {
        $order = $this->produce_service->addOrder();
        NewOrderEvent::dispatch($order);
        return $this->success($order, self::$RESPONSE_OK, \Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
    }
}
