<?php namespace App\Http\Controllers;


use App\Actions\User\ChangeUserStatusAction;
use App\Actions\User\CreateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UsersList;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $users = app(UsersList::class)->get();
        return UserResource::collection($users);
//        return view('users',compact('users'));
    }

    public function create()
    {

    }

    public function edit(User $user)
    {

        return $user;
    }

    public function show(User $user)
    {

        return $user;
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
    public function destroy(User $user)
    {
        app(DeleteUserAction::class)->delete($user);
        return response()->json(['message' => 'User deleted successfully'], 200);

    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(User $user)
    {
        app(ChangeUserStatusAction::class)->activate($user);
        return response()->json(['message' => 'User activated successfully'], 200);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(User $user)
    {
        app(ChangeUserStatusAction::class)->deactivate($user);
        return response()->json(['message' => 'User deactivated successfully'], 200);
    }


}
