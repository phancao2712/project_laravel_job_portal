<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFoundingInfoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'industry_type_id' => ['required', 'integer'],
            'organization_type_id' => ['required', 'integer'],
            'team_size_id' => ['required', 'integer'],
            'establishment_date' => ['required', 'date'],
            'website' => ['active_url'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'country' => ['nullable'],
            'province' => ['nullable'],
            'district' => ['nullable'],
            'address' => ['string', 'max:255'],
            'maplink' => ['nullable'],
        ];
    }
}
