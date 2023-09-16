<?php

namespace App\Repositories\ShoppingCart;

use App\Models\ShoppingCart;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

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

    public function updateCartItemsOrderId(int $order_id): void
    {
        $this->getModel()->where('user_id', Auth::id())
            ->where('order_id', null)
            ->update(['order_id' => $order_id]);
    }
}
