<?php
namespace App\Services;

class Notify {
    static function CreateNotify(){
        return flash()
        ->success('Create Success.')
        ->flash();
    }

    static function UpdateNotify(){
        return flash()
        ->success('Update Success.')
        ->flash();
    }

    static function LoginNotify(){
        return flash()
        ->success('Login Success.')
        ->flash();
    }

    static function DeleteNotify(){
        return flash()
        ->success('Delete Success.')
        ->flash();
    }

    static function LogoutNotify(){
        return flash()
        ->success('Logout Success.')
        ->flash();
    }

    static function ErrorNotify($error){
        return flash()
        ->error($error)
        ->flash();
    }

    static function SuccessNotify($message){
        return flash()
        ->success($message)
        ->flash();
    }
}
