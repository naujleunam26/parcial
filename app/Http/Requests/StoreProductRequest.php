<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'available' => 'boolean',
            'release_date' => 'required|date',
            'category' => 'nullable|string|max:255',
            'attributes' => 'nullable|json',
        ];
    }
    
}
