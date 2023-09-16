<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface iProductRepository
{
    public function saveImages(Product $product, array $images);
    public function list(array $criteria, int $count, string $sort_by = null): mixed;
}
