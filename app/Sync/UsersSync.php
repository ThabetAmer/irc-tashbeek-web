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
     * @var MobileWorkersRequest
     */
    private $mobileWorkersRequest;

    private $trials = 3;

    /**
     * UsersSync constructor.
     * @param UsersRequest $request
     * @param MobileWorkersRequest $mobileWorkersRequest
     */
    public function __construct(UsersRequest $request, MobileWorkersRequest $mobileWorkersRequest)
    {
        $this->request = $request;
        $this->mobileWorkersRequest = $mobileWorkersRequest;
    }

    public function make($page = 1)
    {
        $this->sync($page, $this->request);

        $this->sync($page, $this->mobileWorkersRequest);
    }

    /**
     * Sync many users to database using CommCare response objects
     *
     * @param $users
     */
    protected function saveUsers($users)
    {
        foreach ($users as $user) {
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
        $user = User::where('commcare_id', $data['id'])->first();

        $userByEmail = User::where('email', $data['email'])->first();

        if (!$user) {
            $user = $userByEmail;
        }

        if (!$user) {
            $user = new User;
            $user->password = Hash::make(implode('_', [$user->name, $user->commcare_id, time()]));
        }

        if (!$userByEmail) {
            $user->email = $data['email'];
        }

        $user->commcare_id = $data['id'];

        $user->name = array_get($data, 'first_name') . ' ' . array_get($data, 'last_name');

        $user->commcare_username = array_get($data, 'username');

        $user->save();
    }

    protected function sync($page = 1, $request)
    {
        $response = null;

        do {
            try {
                $response = $request->data(['page' => $page]);
                $this->saveUsers($response['objects']);
            } catch (\Exception $exception) {

            }
        } while ($this->trials-- != 0 && !$response);

        if (!$response) {
            throw new \Exception('UsersSync: Failed to get data from commcare [page: ' . $page . ']');
        }

        if (($response ?? null) and !is_null($response['meta']['next'])) {
            $this->sync($page + 1, $request);
        }
    }
}