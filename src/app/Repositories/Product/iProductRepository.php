<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface iProductRepository
{
    public function saveImages(Product $product, array $images);
}
