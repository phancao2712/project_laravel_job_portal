<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RazorpayUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'razorpay_status' => ['required', 'in:active,inactive'],
            'razorpay_country' => ['required'],
            'razorpay_currency_name' => ['required'],
            'razorpay_currency_rate' => ['required', 'numeric'],
            'razorpay_key' => ['required'],
            'razorpay_secret_key' => ['required']
        ];
    }
}
