<?php
/**
 * Created by PhpStorm.
 * User: mohammedsehweil
 * Date: 12/12/18
 * Time: 2:38 PM
 */


if (!function_exists('case_type')) {
    function case_type($class)
    {
        return kebab_case(class_basename($class));
    }
}


if (!function_exists('get_case_type_model')) {
    function get_case_type_model($case_type)
    {
        $class = studly_case($case_type);
        $class = "App\\Models\\$class";

        if (!class_exists($class)) {
            abort(500, "Class not found");
        }

        $model = app($class);

        if (!$model instanceof \App\Models\SyncableInterface) {
            abort(500, "API Model should implement SyncableInterface");
        }

        return $model;
    }
}




