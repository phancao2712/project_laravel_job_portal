<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CandidateProfileAccountUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country' => ['required', 'integer'],
            'district' => ['nullable', 'integer'],
            'province' => ['nullable', 'integer'],
            'address' => ['nullable', 'string'],
            'phone_one' => ['nullable', 'string'],
            'phone_two' => ['nullable', 'string'],
            'email' => ['nullable', 'string']
        ];
    }
}
