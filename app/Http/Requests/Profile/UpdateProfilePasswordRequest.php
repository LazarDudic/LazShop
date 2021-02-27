<?php

namespace App\Http\Requests\Profile;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePasswordRequest extends FormRequest
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
            'old_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
            'new_password_confirmation' => ['same:new_password'],
        ];
    }
}
