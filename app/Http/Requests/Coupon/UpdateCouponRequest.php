<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'code'        => ['required', 'string', 'unique:coupons,code,'.$this->coupon->id],
            'type'        => ['required', 'in:fixed,percent'],
            'amount'      => ['required', 'integer', 'min:1'],
            'expiry_date' => ['nullable', 'required_if:quantity,null', 'date', 'after:today'],
        ];
    }
}
