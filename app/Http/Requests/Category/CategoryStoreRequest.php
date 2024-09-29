<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('categories')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Категория с таким именем уже существует',
        ];
    }
}
