<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Models;


trait Routable
{
    public function getDetailsUrlAttribute()
    {
        $caseType = str_plural(case_type(static::class));
        return route(str_plural($caseType ) . '.show', $this->getKey());
    }
}