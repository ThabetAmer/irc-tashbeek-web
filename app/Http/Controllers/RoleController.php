<?php namespace App\Http\Controllers;


use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();

        return RoleResource::collection($roles);
    }


}
