<?php

use App\Models\Candidate;
use App\Models\Company;

/** check error input **/
if (!function_exists('hasError')) {
    function hasError($errors, $name): ?String
    {
        return $errors->has($name) ? 'is-invalid' : '';
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
        $requiredField = [
            'logo', 'banner', 'name', 'bio', 'vision',
            'industry_type_id', 'organization_type_id', 'team_size_id', 'phone', 'email', 'country'
        ];
        $completeProfile = Company::where('user_id', Auth::user()->id)->first();

        foreach ($requiredField as $field) {
            if (empty($completeProfile->{$field})) {
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
            if (empty($completeProfile->{$field})) {
                return false;
            }
        }

        return true;
    }
}

/** format date **/
if (!function_exists('formatDate')) {
    function formatDate(?string $date): string
    {
        if ($date) {
            return date('d/m/Y', strtotime($date));
        }
        return '';
    }
}

/** get user plan  **/
if (!function_exists('storeUserPlanInfo')) {
    function storeUserPlanInfo()
    {
        session()->forget('user_plan');
        session(['user_plan' => isset(auth()->user()->company->userPlan) ? auth()?->user()?->company?->userPlan : []]);
    }
}

/** format location  **/
if (!function_exists('formatLocation')) {
    function formatLocation($country = null, $province = null, $district = null, $address = null): string
    {
        $location = '';

        if ($address) {
            $location .= $address;
        }
        if ($district) {
            $location .= $address ? ', ' . $district : $district;
        }
        if ($province) {
            $location .= $district ? ', ' . $province : $province;
        }
        if ($country) {
            $location .= $province ? ', ' . $country : $country;
        }

        return $location;
    }

    /** format location  **/
    if (!function_exists('calculateEarning')) {
        function calculateEarning($amount): string
        {
            $total = 0;
            foreach ($amount as $key => $value) {
                $amount = intval(preg_replace('/[^0-9]/', '', $value));
                $total += $amount;
            }

            return $total;
        }
    }

    /** format location  **/
    if (!function_exists('canAccess')) {
        function canAccess($permissions): bool
        {
            $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
            $superAdmin = auth()->guard('admin')->user()->hasRole('Super Admin');

            if ($permission || $superAdmin) {
                return true;
            }

            return false;
        }
    }

    if (!function_exists('deleteFile')) {
        function deleteFile($path)
        {
            if (isset($path)) {
                $oldFilePath = public_path($path);
                dd($oldFilePath);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }
    }
}
