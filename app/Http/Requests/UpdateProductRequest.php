<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'affiliate_url' => ['required', 'url', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
