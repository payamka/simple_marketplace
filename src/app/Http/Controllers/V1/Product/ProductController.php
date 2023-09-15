<?php

namespace App\Http\Controllers\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Product\CreateProductRequest;
use Illuminate\Http\Request;
use App\Services\Product\iProductService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\stringEqualsStringIgnoringLineEndings;

class ProductController extends Controller
{
    public function __construct(private readonly iProductService $product_service)
    {
    }
    public function index()
    {
        //
    }

    public function store(CreateProductRequest $request)
    {
        $product = $this->product_service->create($request);
        return $this->success($product, self::$RESPONSE_OK, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $this->product_service->destroy($id, Auth::id());
        return $this->success(null, self::$RESPONSE_OK, Response::HTTP_NO_CONTENT);
    }
}
