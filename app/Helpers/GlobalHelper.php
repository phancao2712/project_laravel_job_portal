<?php

/** check error input **/

use App\Models\Company;

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

/** check complete profile **/
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
