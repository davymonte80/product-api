<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        // Allow all users for now, policy will handle update/delete restrictions
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|max:99999999999999999999.99',
            'description' => 'nullable|string',
        ];

        // Business logic: if price > 1000, description is required
        if ($this->input('price') > 1000) {
            $rules['description'] = 'required|string';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a valid number.',
            'price.max' => 'The product price may not be greater than 20 digits.',
            'description.required' => 'The description is required when the price is greater than 1000.',
        ];
    }
}
