<?php
namespace App\Traits;

trait Searchable {
    function search($query, array $fieldname){
        if(request()->has('search')){
            return $query->where(function($subquery) use ($fieldname) {
                foreach ($fieldname as $field) {
                    $subquery->orWhere($field , 'like', '%'. request('search') . '%');
                }
            });
        }
        return;
    }
}
?>
