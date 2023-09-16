<?php

namespace App\Http\Controllers\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Product\AddToShoppingCartRequest;
use App\Http\Requests\V1\Product\UpdateShoppingCartRequest;
use App\Services\Product\iProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function __construct(private readonly iProductService $product_service)
    {
    }

    public function index()
    {
        $items = $this->product_service->cartItems();
        return $this->success($items, self::$RESPONSE_OK, Response::HTTP_OK);
    }

    public function store(AddToShoppingCartRequest $request)
    {
        $input = $request->validated();
        $item = $this->product_service->addToCart($input['product_id'], $input['quantity']);
        return $this->success($item, self::$RESPONSE_OK, Response::HTTP_OK);
    }

    public function update(UpdateShoppingCartRequest $request, string $id)
    {
        $input = $request->validated();
        $item = $this->product_service->updateCart($id, $input['quantity']);
        return $this->success($item, self::$RESPONSE_OK, Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        $this->product_service->removeFromCart($id);
        return $this->success(null, self::$RESPONSE_OK, Response::HTTP_NO_CONTENT);
    }
}
