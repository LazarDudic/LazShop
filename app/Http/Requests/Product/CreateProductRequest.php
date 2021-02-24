<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['mimes:jpg,jpeg,png', 'nullable'],
            'category_id' => ['required', 'integer'],
            'status' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category is required.',
        ];
    }
}
