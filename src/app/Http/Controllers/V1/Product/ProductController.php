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
    public function index(Request $request)
    {
        $list = $this->product_service->list($request);
        if($list)
            return $this->success($list, self::$RESPONSE_OK, Response::HTTP_OK);

        return $this->error(null, self::$RESPONSE_FAIL, Response::HTTP_NO_CONTENT);
    }

    public function store(CreateProductRequest $request)
    {
        $product = $this->product_service->create($request);
        return $this->success($product, self::$RESPONSE_OK, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $product = $this->product_service->find($id);

        if($product)
            return $this->success($product, self::$RESPONSE_OK, Response::HTTP_OK);

        return $this->error(null, self::$RESPONSE_FAIL, Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id)
    {
        $this->product_service->destroy($id, Auth::id());
        return $this->success(null, self::$RESPONSE_OK, Response::HTTP_NO_CONTENT);
    }
}
