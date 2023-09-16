<?php

namespace App\Repositories\Product;

use App\Models\Image;
use App\Models\Product;
use App\Models\ShippingPrice;
use App\Repositories\Contracts\AbstractRepository;

class ProductRepository extends AbstractRepository implements iProductRepository
{
    protected $model = Product::class;

    public function saveImages(Product $product, array $images)
    {
        $image_models = [];

        foreach ($images as $image) {
            $image_models[] = new Image($image);
        }

        $product->images()->saveMany($image_models);
    }

    public function saveShippingPrice(Product $product, int $price)
    {
        return $product->images()->save(
            new ShippingPrice(['price' => $price])
        );
    }

    public function list(array $criteria, int $count, string $sort_by = null): mixed
    {
        return $this->findAllPaginate($criteria, $count, $sort_by, ['images', 'user']);
    }
}
