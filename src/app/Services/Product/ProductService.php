<?php

namespace App\Services\Product;

use App\Http\Requests\V1\Product\CreateProductRequest;
use App\Repositories\Product\iProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService implements iProductService
{
    private $product = null;

    public function __construct(private readonly iProductRepository $product_repo)
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
            foreach ($images as $image) {
                $uploaded_path = Storage::disk('public')->put($path, $image);

                if ($uploaded_path)
                    $uploaded[]['path'] = $uploaded_path;

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
}
