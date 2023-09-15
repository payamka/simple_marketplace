<?php

namespace App\Repositories\Product;

use App\Models\Image;
use App\Models\Product;
use App\Repositories\Contracts\AbstractRepository;

class ProductRepository extends AbstractRepository implements iProductRepository
{
    protected $model = Product::class;

    public function saveImages(Product $product, array $images)
    {
        $image_models = [];
        foreach ($images as $image){
            $image_models[] = new Image($image);
        }

        $product->images()->saveMany($image_models);
    }
}
