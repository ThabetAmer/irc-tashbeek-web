<?php namespace App\Actions\User;

use App\Models\Form;
use App\Models\User;
use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobSeeker;
use App\Sync\Cases\JobOpening;

class DeleteUserAction
{
    /**
     * @param User $user
     * @throws \Exception
     */
    public function delete(User $user)
    {
        $user->delete();
    }
}

