<?php
/** check error input **/
if(!function_exists('hasError')){
    function hasError($errors, $name) : ?String {
        return $errors->has('name') ? 'is-invalid' : '';
    }
}

/** active sidebar **/
if(!function_exists('setSideBarActive')){
    function setSideBarActive(array $routes) : ?String {
        foreach ($routes as $route) {
            if(request()->routeIs($route)){
                return 'active';
            }
        }
        return null;
    }
}
?>
