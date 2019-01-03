<?php namespace App\Actions\User;

use App\Models\Form;
use App\Models\User;
use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobSeeker;
use App\Sync\Cases\JobOpening;

class UpdateUserAction
{
    /**
     * @param User $user
     * @param $data
     * @return User|int
     */
    public function update(User $user, $data)
    {
        $user = User::query()
            ->update($data);
        return $user;
    }

}

