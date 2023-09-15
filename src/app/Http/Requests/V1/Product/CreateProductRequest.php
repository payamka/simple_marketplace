<?php

namespace App\Http\Requests\V1\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'price' => 'required|numeric|min:1000|max:999999999',
            'images' => 'nullable|sometimes|array',
            'images.*' => 'nullable|sometimes|file|max:20480|mimes:jpg,jpeg,png',
        ];
    }
}
