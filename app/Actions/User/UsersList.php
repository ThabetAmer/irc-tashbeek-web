<?php namespace App\Actions\User;

use App\Http\Filters\UserFilter;
use App\Models\User;

class UsersList
{
    public function get($pageLimit = 15)
    {
        $query = User::query();

        $query->filter(app(UserFilter::class));

        return $query->paginate($pageLimit);
        
    }
}

