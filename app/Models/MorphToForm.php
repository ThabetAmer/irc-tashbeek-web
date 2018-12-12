<?php namespace App\Models;


trait MorphToForm
{
    public function forms()
    {
        return $this->morphToMany(Form::class, 'case_form')->withTimestamps();
    }
}