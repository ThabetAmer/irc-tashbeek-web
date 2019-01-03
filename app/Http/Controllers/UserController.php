<?php namespace App\Http\Controllers;


use App\Actions\User\CreateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function edit()
    {

    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $user = app(CreateUserAction::class)->create($request->all());
        return response()->json(['message' => 'User created successfully'], 200);
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user = app(UpdateUserAction::class)->update($user, $request->all());
        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user)
    {
        $user = app(DeleteUserAction::class)->delete($user);
        return response()->json(['message' => 'User deleted successfully'], 200);

    }

}
