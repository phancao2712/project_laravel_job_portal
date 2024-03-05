<?php
use App\Models\Candidate;
use App\Models\Company;

/** check error input **/
if (!function_exists('hasError')) {
    function hasError($errors, $name): ?String
    {
        return $errors->has('name') ? 'is-invalid' : '';
    }
}

/** active sidebar **/
if (!function_exists('setSideBarActive')) {
    function setSideBarActive(array $routes): ?String
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return null;
    }
}

/** check complete company profile **/
if (!function_exists('checkCompleteProfile')) {
    function checkCompleteProfile(): bool
    {
        $requiredField = ['logo', 'banner', 'name', 'bio', 'vision',
        'industry_type_id', 'organization_type_id', 'team_size_id', 'phone', 'email', 'country'];
        $completeProfile = Company::where('user_id', Auth::user()->id)->first();

        foreach ($requiredField as $field) {
            if(empty($completeProfile->{$field})){
                return false;
            }
        }

        return true;
    }
}

/** check complete candidate profile **/
if (!function_exists('checkCompleteCandidateProfile')) {
    function checkCompleteCandidateProfile(): bool
    {
        $requiredField = [
            'experience_id',
            'profession_id',
            'fullname',
            'image',
            'gender',
            'marital_status',
            'status',
            'birth_date',
            'bio',
            'country'

        ];
        $completeProfile = Candidate::where('user_id', Auth::user()->id)->first();

        foreach ($requiredField as $field) {
            if(empty($completeProfile->{$field})){
                return false;
            }
        }

        return true;
    }
}

/** format date **/
if (!function_exists('formatDate')) {
    function formatDate(string $date): string
    {
        return date('d-m-Y', strtotime($date));
    }
}
