<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => ['required', Rule::unique('products')->ignore($this->id)],
            'description' => ['sometimes', 'nullable'],
            'price' => ['required', 'integer'],
            'categoryId' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Товар с таким именем уже существует',
        ];
    }
}
