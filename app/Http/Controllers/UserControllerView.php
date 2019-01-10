<?php namespace App\Http\Controllers;


use App\Actions\User\ChangeUserStatusAction;
use App\Actions\User\CreateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UsersList;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

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
        return view('users.edit',compact('user'));
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

}
