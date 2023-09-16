<?php

namespace App\Http\Controllers\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Product\CreateShippingPriceRequest;
use App\Services\Product\iProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippingPriceController extends Controller
{
    public function __construct(private readonly iProductService $product_service)
    {
    }

    public function store(CreateShippingPriceRequest $request)
    {
        $price = $this->product_service->createShippingPrice(
            $request->product_id,
            $request->price,
        );

        if ($price)
            return $this->success($price, self::$RESPONSE_OK, Response::HTTP_CREATED);

        return $this->error(null, self::$RESPONSE_FAIL, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
