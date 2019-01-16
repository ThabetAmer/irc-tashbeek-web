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

if (!function_exists('case_resource_collection')) {
    /**
     * @param $caseType
     * @param mixed ...$args
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    function case_resource_collection($caseType, ...$args)
    {
        $class = studly_case($caseType);

        $class = "App\\Http\\Resources\\CaseResources\\{$class}ResourceCollection";

        if (!class_exists($class)) {
            $class = "App\\Http\\Resources\\CaseDataResource";
        }

        return new $class(...$args);
    }
}

if (!function_exists('case_resource')) {
    /**
     * @param $caseType
     * @param mixed ...$args
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    function case_resource($caseType, ...$args)
    {
        $class = studly_case($caseType);

        $class = "App\\Http\\Resources\\CaseResources\\{$class}Resource";

        if (!class_exists($class)) {
            $class = "App\\Http\\Resources\\CaseResource";
        }

        return new $class(...$args);
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

if (!function_exists('trans_commcare')) {
    function trans_commcare($options, $default = null, $locale = null)
    {
        if(!$locale){
            $locale = \App::getLocale();
        }

        if(array_has($options,$locale)){
            return $options[$locale];
        }

        $alias = config('laravellocalization.supportedLocales.' . $locale . '.' . 'alias');

        if(array_has($options,$alias)){
            return $options[$alias];
        }

        $fallbackLocale = config('app.fallback_locale');

        if(array_has($options,$fallbackLocale)){
            return $options[$fallbackLocale];
        }

        return $default;
    }
}

if (!function_exists('switch_url')) {
    function switch_url($html = false){

        $locale = \App::getLocale();

        $locales = [];

        foreach(config('laravellocalization.supportedLocales') as $key => $value){
            if($locale !== $key){
                $locales[] = array_merge($value,['locale_key' => $key]);
            }
        }

        if(!count($locales)){
            return ;
        }

        $first = reset($locales);

        $url = \LaravelLocalization::getLocalizedURL($first['locale_key']);

        if(!$html){
            return $url;
        }

        return "<a href='{$url}' class='text-white'>{$first['native']}</a>";
    }
}