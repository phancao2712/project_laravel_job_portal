<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class JobPortStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'job_category_id' => ['required', 'integer'],
            'vacancies' => ['required', 'max:255'],
            'deadline' => ['required', 'date'],
            'country' => ['nullable', 'integer'],
            'province' => ['nullable', 'integer'],
            'district' => ['nullable', 'integer'],
            'address' => ['nullable', 'max:255'],
            'salary_mode' => ['required','in:range,custom'],
            'min_salary' => ['nullable', 'integer'],
            'max_salary' => ['nullable', 'integer'],
            'custom_salary' => ['nullable', 'integer'],
            'salary_type' => ['required','integer'],
            'job_experience_id' => ['required', 'integer'],
            'job_role_id' => ['required', 'integer'],
            'education_id' => ['required', 'integer'],
            'job_type_id' => ['required', 'integer'],
            'tags' => ['required'],
            'benefits' => ['required'],
            'featured' => ['nullable', 'integer'],
            'highlight' => ['nullable', 'integer'],
            'skills' => ['required'],
            'receive_application' => ['required'],
            'description' => ['required'],
        ];
    }
}
