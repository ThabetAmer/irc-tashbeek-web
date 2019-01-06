<?php namespace App\Actions\User;

use App\Models\User;

class UsersList
{
    public function get($filters = [], $pageLimit = 15)
    {
        return User::query()
            ->paginate($pageLimit);
    }
}

