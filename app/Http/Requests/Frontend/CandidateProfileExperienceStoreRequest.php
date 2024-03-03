<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CandidateProfileExperienceStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company' => ['required', 'max:255'],
            'department' => ['required', 'max:255'],
            'designation' => ['required', 'max:255'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'responsibilites' => ['nullable'],
            'current_working' => ['nullable']
        ];
    }
}
