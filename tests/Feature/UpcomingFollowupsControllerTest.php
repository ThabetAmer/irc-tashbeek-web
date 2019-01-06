<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpcomingFollowupsControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_requires_authentication()
    {
        $this->json('get',route('api.upcoming-followups'))
            ->assertStatus(401);
    }

    public function test_it_return_list_of_upcoming_follow_ups()
    {
        $this->loginApi();

        $this->json('get',route('api.upcoming-followups'))
            ->assertStatus(200);
    }
}
