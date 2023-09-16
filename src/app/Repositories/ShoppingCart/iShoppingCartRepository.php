<?php

namespace App\Repositories\ShoppingCart;

interface iShoppingCartRepository
{
    public function deleteFromCart(int $product_id, int $user_id): void;
}
