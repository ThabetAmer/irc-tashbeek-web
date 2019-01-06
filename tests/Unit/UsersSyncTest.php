<?php

namespace Tests\Unit;

use App\Models\User;
use App\Sync\UsersSync;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_create_new_users()
    {
        $this->mockUsersRequest();

        app(UsersSync::class)->make();

        $this->assertCount(
            20, User::all()
        );
    }


    public function test_it_will_update_exists_users()
    {

        factory(User::class)->create([
            'commcare_id' => '397406ffcbac576042e0f3e6f02212cc'
        ]);

        factory(User::class)->create([
            'email' => 'muntasir.shami@hotmail.com'
        ]);

        $this->mockUsersRequest();

        app(UsersSync::class)->make();

        $this->assertCount(
            20, User::all()
        );

        $this->assertNotEmpty(
            User::where('email','muntasir.shami@hotmail.com')->first()->commcare_id
        );
    }

}
