<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => ['required', Rule::unique('categories')->ignore($this->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Категория с таким именем уже существует',
        ];
    }
}
