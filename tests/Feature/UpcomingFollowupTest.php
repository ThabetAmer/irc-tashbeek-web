<?php

namespace Tests\Feature;

use App\Models\JobSeeker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpcomingFollowupTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_authentication()
    {
        $this->json('get',route('api.upcoming-followups'))
            ->assertStatus(401);
    }

    public function test_it_return_200_status()
    {
        $this->loginApi();

        $this->json('get',route('api.upcoming-followups'))
            ->assertStatus(200);
    }

    public function test_it_return_list_of_upcoming_followups()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $jobSeeker->followups()->create([
            'followup_period' => 'monthly',
            'type' => 'scheduled',
            'followup_date' => now()->toDateString()
        ]);

        $this->json('get',route('api.upcoming-followups'))
            ->assertJson([
                'data' => [
                    [
                        'id' => 1,
                        'followup_type' => 'job-seeker' ,
                        'followup_date' => now()->toDateString(),
                        'followup_period' => 'monthly',
                        'followup' => [
                            'id' => $jobSeeker->id,
                            'name' => $jobSeeker->displayName()
                        ]
                    ]
                ]
            ])
            ->assertJsonCount(1,'data')
            ->assertStatus(200);
    }

    public function test_it_throw_validation_error_on_invalid_date()
    {
        $this->loginApi();

        $this->json('get',route('api.upcoming-followups'),['followup_date' => '5-2-3'])
            ->assertJsonValidationErrors(['followup_date'])
            ->assertStatus(422);
    }

    public function test_it_fetch_only_upcoming_followups_for_a_date()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $jobSeeker->followups()->create([
            'followup_period' => 'monthly',
            'type' => 'scheduled',
            'followup_date' => now()->toDateString()
        ]);

        $jobSeeker->followups()->create([
            'followup_period' => 'monthly',
            'type' => 'scheduled',
            'followup_date' => now()->toDateString()
        ]);

        $jobSeeker->followups()->create([
            'followup_period' => 'monthly',
            'type' => 'scheduled',
            'followup_date' => now()->addDay(2)->toDateString()
        ]);

        $this->json('get',route('api.upcoming-followups'),['followup_date' => now()->addDay(2)->toDateString()])
            ->assertJson([
                'data' => [
                    [
                        'followup_date' => now()->addDay(2)->toDateString(),
                    ]
                ]
            ])
            ->assertJsonCount(1,'data')
            ->assertStatus(200);
    }
}
