<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
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
            'search' => ['nullable', 'string', 'max:255'],
            'sort_field' => ['required', 'in:created_at,updated_at,name,price,status'],
            'sort_direction' => ['required', 'in:asc,desc'],
        ];
    }
}
