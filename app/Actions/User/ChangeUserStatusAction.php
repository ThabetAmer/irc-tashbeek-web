<?php namespace App\Actions\User;

use App\Models\User;

class ChangeUserStatusAction
{
    /**
     * @param User $user
     */
    public function activate(User $user)
    {
        $status = $user->status;
        if ($status === 'deactivated') {
            $user->update(['status' => 'activated']);
        }
    }


    /**
     * @param User $user
     */
    public function deactivate(User $user)
    {
        $status = $user->status;
        if ($status === 'activated') {
            $user->update(['status' => 'deactivated']);
        }
    }
}

