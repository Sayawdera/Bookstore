<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRelaiseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.title' => 'required|array',
            'data.description' => 'required|array',
            'data.pdf' => 'required|array',
            'data.status_price' => 'required|boolean',
            'data.product_id' => 'nullable|numeric',
        ];
    }
}