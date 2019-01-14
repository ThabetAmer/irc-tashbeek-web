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
        $roles = $this->getRoles();

        return view('users.create',compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = $this->getRoles($user);

        return view('users.edit', compact('user', 'roles'));
    }

    public function show(User $user)
    {
        $roles = $this->getRoles($user)->filter(function($role){
            return $role['has_role'] === true;
        });

        return view('users.show', compact('user', 'roles'));
    }

    protected function getRoles($user = null)
    {
        return Role::all()
            ->transform(function ($role) use ($user) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'has_role' => $user ? $user->hasRole($role) : false
                ];
            });
    }

}
