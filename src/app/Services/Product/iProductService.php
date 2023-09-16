<?php

namespace App\Services\Product;

use App\Http\Requests\V1\Product\CreateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface iProductService
{
    public function create(CreateProductRequest $request): Model;
    public function destroy(int $id, int|null $user_id = null): void;
    public function find(int $id): Model|null;
    public function createShippingPrice(int $product_id, int $price): Model|bool;
    public function addToCart(int $product_id, int $quantity): Model;
    public function updateCart(int $product_id, int $quantity): Model|null;
    public function removeFromCart(int $id): void;
    public function cartItems(): LengthAwarePaginator;
}
