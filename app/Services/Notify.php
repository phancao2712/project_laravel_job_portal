<?php
namespace App\Services;

class Notify {
    static function CreateNotify(){
        return notify()->success('Create Success','Success!');
    }

    static function UpdateNotify(){
        return notify()->success('Update Success','Success!');
    }

    static function LoginNotify(){
        return notify()->success('Login Success','Success!');
    }
}
