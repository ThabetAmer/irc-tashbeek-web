<?php namespace App\Http\Controllers;


use App\Actions\User\ChangeUserStatusAction;
use App\Actions\User\CreateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UsersList;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserControllerView extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');

    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function show(User $user)
    {
        $roles = Role::all()
            ->transform(function ($role) use($user){
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'has_role' => $user->hasRole($role)
                ];
            });

        return view('users.show', compact('user','roles'));
    }

}
