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


if (!function_exists('get_model_from_case_type')) {
    function get_model_from_case_type($case_type)
    {
        $class = studly_case($case_type);
        return app("App\\Models\\$class");
    }
}




