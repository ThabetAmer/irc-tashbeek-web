<?php
/**
 * Created by PhpStorm.
 * User: mohammedsehweil
 * Date: 1/13/19
 * Time: 6:21 PM
 */

namespace App\Http\Controllers;


trait HasAuth
{
    public function isEso()
    {
        return function () {
            return auth()->user()->hasRole(config('roles.eso_id'));
        };
    }


    public function isEsso()
    {
        return function () {
            return auth()->user()->hasRole(config('roles.esso_id'));
        };
    }


}