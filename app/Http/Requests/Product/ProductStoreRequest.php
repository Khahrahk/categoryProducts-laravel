<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('issues')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Товар с таким именем уже существует',
        ];
    }
}
