<?php

namespace App\Http\Requests\Frontend;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
        $role = [
            'name' => ['required', 'string', 'max:500'],
            'logo' => ['max:1500', 'image'],
            'banner' => ['max:1500', 'image'],
            'bio' => ['required'],
            'vision' => ['required'],
        ];

        $company = Company::where('user_id', auth()->user()->id)->first();

        if(empty($company) || !$company?->logo){
            $role['logo'] = 'required';
        }
        if(empty($company) || !$company?->banner){
            $role['banner'] = 'required';
        }

        return $role;
    }
}
