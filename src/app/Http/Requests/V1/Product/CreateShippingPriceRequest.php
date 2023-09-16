<?php

namespace App\Http\Requests\V1\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateShippingPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:1000|max:999999999',
        ];
    }
}
