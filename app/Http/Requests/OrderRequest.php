<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'first_name'     =>'required|min:3',
            'last_name'      =>'required',
            'phone'         =>'required|regex:/(0)[0-9]{9}/|min:6|max:11',
            'address'       =>'required',
            'policy_check'  =>'required',
            // 'payment_method'=>'required|in:COD,AP',
        ];
    }
    public function messages()
    {
        return [
            'policy_check.required'  => 'Terms and Policy checkbox should be checked to place an order',
            'payment_method.required'=> 'Please choose a payment method',
            'payment_method.in'      => 'Please choose a payment method',
        ];
    }
}
