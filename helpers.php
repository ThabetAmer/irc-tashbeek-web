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
    function get_case_type_model($caseType)
    {
        $class = studly_case($caseType);

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

if (!function_exists('get_case_type_resource_class')) {
    function get_case_type_resource_class($caseType)
    {
        $class = studly_case($caseType);

        $class = "App\\Http\\Resources\\CaseResources\\{$class}ResourceCollection";

        if (!class_exists($class)) {
            $class = "App\\Http\\Resources\\CaseDataResource";
        }

        return $class;
    }
}


if (!function_exists('base_commcare_field_name')) {
    function base_commcare_field_name($field)
    {
        $field = explode('/', $field);
        return end($field);
    }
}


if (!function_exists('withCount')) {
    function withCount($model)
    {
        $withCountArray = $model->withCount ?? [];
        return array_map(function ($value) {
            return $value . '_count';
        }, $withCountArray);
    }
}






