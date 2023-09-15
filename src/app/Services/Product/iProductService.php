<?php

namespace App\Services\Product;

use App\Http\Requests\V1\Product\CreateProductRequest;
use Illuminate\Database\Eloquent\Model;

interface iProductService
{
    public function create(CreateProductRequest $request): Model;
    public function destroy(int $id, int|null $user_id = null): void;
}
