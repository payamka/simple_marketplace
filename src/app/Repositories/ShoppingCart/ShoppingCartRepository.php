<?php

namespace App\Repositories\ShoppingCart;

use App\Models\ShoppingCart;
use App\Repositories\Contracts\AbstractRepository;

class ShoppingCartRepository extends AbstractRepository implements iShoppingCartRepository
{
    protected $model = ShoppingCart::class;

    public function deleteFromCart(int $product_id, int $user_id): void
    {
        $product = $this->find([
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);

        if ($product) $product->delete();
    }
}
