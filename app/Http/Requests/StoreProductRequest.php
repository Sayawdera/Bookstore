<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'data.title' => 'required|array',
            'data.description' => 'required|array',
            'data.photo' => 'required|array',
            'data.pdf' => 'required',
            'data.selling_method' => 'required|boolean',
            'data.price' => 'required|numeric',
            'data.category_id' => 'required|numeric',
            'data.brand_id' => 'required|numeric',
            'data.user_id' => 'required|numeric',
            'data.author_id' => 'required|numeric',

        ];
    }
}