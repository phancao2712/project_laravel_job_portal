<?php
/** check error input **/
if(!function_exists('hasError')){
    function hasError($errors, $name) : ?String {
        return $errors->has('name') ? 'is-invalid' : '';
    }
}
?>
