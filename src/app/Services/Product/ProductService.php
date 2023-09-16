<?php

namespace App\Services\Product;

use App\Http\Requests\V1\Product\CreateProductRequest;
use App\Repositories\Product\iProductRepository;
use App\Repositories\ShoppingCart\iShoppingCartRepository;
use App\Repositories\Order\iOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ProductService implements iProductService
{
    private $product = null;

    public function __construct(private readonly iProductRepository      $product_repo,
                                private readonly iShoppingCartRepository $shopping_cart_repo,
                                private readonly iOrderRepository        $order_repo
    )
    {
    }

    public function create(CreateProductRequest $request): Model
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->product = $this->product_repo->create($input);
        $this->product['images'] = $this->attachImages($request->file('images'));
        return $this->product;
    }

    private function attachImages(array|null $images): Collection
    {
        $path = 'product_images';

        if ($this->product == null)
            return [];

        $uploaded = [];
        if (is_array($images))
            $manager = new ImageManager();
        foreach ($images as $image) {
            $uploaded_path = Storage::disk('public')->put($path, $image);

            if ($uploaded_path) {
                $uploaded[]['path'] = $uploaded_path;

                $image_full_path = Storage::disk('public')->path($uploaded_path);

                $image = $manager->make($image_full_path);

                $image->widen(1200)->save($image_full_path);
            }

            $this->product_repo->saveImages($this->product, $uploaded);
        }

        return collect($uploaded)->pluck('path');
    }

    public function destroy(int $id, int|null $user_id = null): void
    {
        $this->product_repo->delete($id, $user_id);
    }

    public function find(int $id): Model|null
    {
        return $this->product_repo->find(
            ['id' => $id],
            ['images']
        );
    }

    public function list(Request $request): mixed
    {
        $criteria = [];
        if ($request->filled('keyword'))
            $criteria[] = ['title', 'like', '%' . $request->keyword . '%'];
        if ($request->filled('max_price'))
            $criteria[] = ['price', '<=', $request->max_price];

        return $this->product_repo->list(
            $criteria,
            $request->input('count', 20),
            $request->input('sort_by', null)
        );
    }

    public function createShippingPrice(int $product_id, int $price): Model|bool
    {
        $product = $this->product_repo->find([
            'id' => $product_id,
            'user_id' => Auth::id()
        ]);

        if ($product) {
            $price = $this->product_repo->saveShippingPrice($product, $price);
            return $price;
        }

        return false;
    }

    public function addToCart(int $product_id, int $quantity): Model
    {
        $current_item = $this->shopping_cart_repo->find([
            'product_id' => $product_id,
            'user_id' => Auth::id()
        ]);

        if ($current_item) {
            $this->shopping_cart_repo->update($current_item, ['quantity' => $current_item->quantity + $quantity]);
            return $current_item;
        }

        return $this->shopping_cart_repo->create([
            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'quantity' => $quantity
        ]);
    }

    public function updateCart(int $product_id, int $quantity): Model|null
    {
        $current_item = $this->shopping_cart_repo->find([
            'product_id' => $product_id,
            'user_id' => Auth::id()
        ]);

        if ($current_item)
            $this->shopping_cart_repo->update($current_item, ['quantity' => $quantity]);

        return $current_item;
    }

    public function removeFromCart(int $id): void
    {
        $this->shopping_cart_repo->deleteFromCart($id, Auth::id());
    }

    public function cartItems(): LengthAwarePaginator
    {
        return $this->shopping_cart_repo->findAllPaginate([
            'user_id' => Auth::id()
        ], 99, null, ['product']);
    }

    public function addOrder(): Model
    {
        $total_price = $this->calqulatePrices();
        $order = $this->order_repo->create([
            'user_id' => Auth::id(),
            'total_cost' => $total_price
        ]);

        $this->shopping_cart_repo->updateCartItemsOrderId($order->id);

        return $order;
    }

    private function calqulatePrices(): int
    {
        $cart_items = $this->cartItems();
        $total_amount = 0;

        foreach ($cart_items as $cart_item) {
            $quantity = $cart_item->quantity;
            $total_amount += $quantity * $cart_item->product->price;
            if (isset($cart_item->product->lastShippingPrice[0]))
                $total_amount += $quantity * $cart_item->product->lastShippingPrice[0]->price;
        }

        return $total_amount;
    }
}
