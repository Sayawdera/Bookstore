<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'data.firstname' => 'required|string',
            'data.lastname' => 'required|string',
            'data.adress' => 'required|string',
            'data.email' => 'required|string',
            'data.phonenumber' => 'required|numeric',
            'data.password' => 'required|string',
            'data.photo' => 'required',
            'data.country_id' => 'nullable|numeric',
            'data.roles.*.role_code' => ['required', 'string'],
            'data.roles.*.status' => ['required', 'boolean']
        ];
    }
}