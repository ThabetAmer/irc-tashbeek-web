<?php namespace App\Sync;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSync
{
    /**
     * @var UsersRequest
     */
    private $request;

    /**
     * UsersSync constructor.
     * @param UsersRequest $request
     */
    public function __construct(UsersRequest $request)
    {
        $this->request = $request;
    }

    public function make($page = 1)
    {
        $response = $this->request->data(['page' => $page]);

        $this->saveUsers($response['objects']);

        if (!is_null($response['meta']['next'])) {
            $this->make($page + 1);
        }
    }

    /**
     * Sync many users to database using CommCare response objects
     *
     * @param $users
     */
    protected function saveUsers($users)
    {
        foreach($users as $user){
            $this->saveUser($user);
        }
    }

    /**
     * Sync single users to database using CommCare response objects item
     *
     * @param $data
     */
    protected function saveUser($data)
    {
        $user = User::where('email',$data['email'])->first();

        if(!$user){
            $user = User::where('commcare_id',$data['id'])->first();
        }

        if(!$user){
            $user = new User;
            $user->email = $data['email'];
            $user->password = Hash::make(implode('_',[$user->name,$user->commcare_id,time()]));
        }

        $user->commcare_id = $data['id'];

        $user->name = array_get($data,'first_name') . ' ' . array_get($data,'last_name');

        $user->save();
    }

}