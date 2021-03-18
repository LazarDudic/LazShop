<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'role_id'    => ['required', 'integer'],
            'country'    => ['required', 'string', 'max:255'],
            'state'      => ['nullable', 'string', 'max:255'],
            'city'       => ['required', 'string', 'max:255'],
            'address'    => ['required', 'string', 'max:255'],
            'zipcode'    => ['required', 'string', 'max:255'],
        ];
    }
}
