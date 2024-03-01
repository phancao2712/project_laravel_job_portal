<?php

namespace App\Http\Requests\Frontend;

use App\Models\candidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBasicInfoRequest extends FormRequest
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
        $rules = [
            'picture' => ['image', 'max:3000'],
            'cv' => ['nullable', 'mimes:pdf,csv,epub', 'max:10000'],
            'fullname' => ['required', 'max:50'],
            'title' => [ 'nullable' ,'string', 'max:255'],
            'experience' => ['required' ,'integer'],
            'website' => ['nullable', 'active_url'],
            'date_of_birth' => ['required', 'date']
        ];

        $candidate = candidate::where('user_id', auth()->user()->id)->first();

        if(empty($candidate) || !$candidate?->image){
            $rules['picture'][] = 'required';
        }


        return $rules;
    }
}
