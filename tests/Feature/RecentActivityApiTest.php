<?php

namespace Tests\Feature;

use App\Models\JobSeeker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecentActivityApiTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_it_requires_auth()
    {
        $this->json('get', route('api.recent-activities'))
            ->assertStatus(401);
    }


    public function test_it_return_activities_per_user()
    {

        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $today = now()->toDateTimeString();

        $yesterday = now()->addDay(-2)->toDateTimeString();

        $jobSeeker->recentActivities()->create([
            'title' => $this->faker->name,
            'user_id' => auth()->id(),
            'created_at' => $today
        ]);

        $jobSeeker->recentActivities()->create([
            'title' => $this->faker->name,
            'user_id' => auth()->id(),
            'created_at' => $today
        ]);

        $jobSeeker->recentActivities()->create([
            'title' => $this->faker->name,
            'user_id' => auth()->id(),
            'created_at' => $today
        ]);

        $jobSeeker->recentActivities()->create([
            'title' => $this->faker->name,
            'user_id' => auth()->id(),
            'created_at' => $yesterday
        ]);

        $jobSeeker->recentActivities()->create([
            'title' => $this->faker->name,
            'user_id' => auth()->id(),
            'created_at' => $yesterday
        ]);

        $jobSeeker->recentActivities()->create([
            'title' => $this->faker->name,
        ]);

        $this->json('get', route('api.recent-activities'))
            ->assertJsonCount(3, 'data.0.items')
            ->assertJsonCount(2, 'data.1.items')
            ->assertJsonCount(2, 'data')
            ->assertStatus(200);
    }
}
