<?php

namespace App\Services\Product;

use App\Repositories\Product\iProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService implements iProductService
{
    private $product = null;

    public function __construct(private readonly iProductRepository $product_repo)
    {
    }

    public function create($request)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->product = $this->product_repo->create($input);
        $this->product['images'] = $this->attachImages($request->file('images'));
        return $this->product;
    }

    private function attachImages($images)
    {
        $path = 'product_images';

        if ($this->product == null)
            return [];

        $uploaded = [];
        if (is_array($images))
            foreach ($images as $image) {
                $uploaded_path = Storage::disk('public')->put($path, $image);

                if ($uploaded_path)
                    $uploaded[]['path'] = $uploaded_path;

                $this->product_repo->saveImages($this->product, $uploaded);
            }

        return collect($uploaded)->pluck('path');
    }
}
