<?php

namespace Tests\Feature;

use App\Models\JobSeeker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpcomingFollowupsCountsTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_requires_auth()
    {

        $this->json('get', route('api.upcoming-followups.counts'))
            ->assertStatus(401);

    }

    public function test_it_requires_valid_followup_date()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $this->json('get', route('api.upcoming-followups.counts'), ['followup_date' => '2-3'])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'followup_date'
            ]);
    }


    public function test_it_return_counts_for_each_date_of_current_month_by_default()
    {
        $this->loginApi();


        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create([
            'user_id' => auth()->id()
        ]);

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->toDateString(), auth()->id());
        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->toDateString(), auth()->id());

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->addDay(2)->toDateString(), auth()->id());

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->addDay(6)->toDateString(), auth()->id());

        $this->json('get', route('api.upcoming-followups.counts'))
            ->assertJson([
                'data' => [
                    [
                        'followup_date' => now()->startOfMonth()->toDateString(),
                        'followup_count' => 2,
                    ],
                    [
                        'followup_date' => now()->startOfMonth()->addDay(2)->toDateString(),
                        'followup_count' => 1,
                    ],
                    [
                        'followup_date' => now()->startOfMonth()->addDay(6)->toDateString(),
                        'followup_count' => 1,
                    ]
                ]
            ])
            ->assertSuccessful();
    }


    public function test_it_return_counts_for_each_date_of_a_given_month()
    {
        $this->withoutExceptionHandling();

        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create([
            'user_id' => auth()->id()
        ]);


        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->toDateString(), auth()->id());
        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->toDateString(), auth()->id());

        $nextMonthDate = now()->startOfMonth()->addMonth(1);
        $this->createJobSeekerFollowup($jobSeeker, $nextMonthDate->toDateString(), auth()->id());

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->addDay(6)->toDateString(), auth()->id());

        $this->json('get', route('api.upcoming-followups.counts'), [
            'followup_date' => $nextMonthDate->format('Y-m')
        ])->assertJson([
            'data' => [
                [
                    'followup_date' => $nextMonthDate->toDateString(),
                    'followup_count' => 1,
                ],
            ]
        ])->assertSuccessful();
    }

    public function test_followups_must_be_shown_per_user()
    {
        $this->withoutExceptionHandling();

        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create([
            'user_id' => auth()->id()
        ]);

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->toDateString(), auth()->id());

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->toDateString(), auth()->id());

        $nextMonthDate = now()->startOfMonth()->addMonth(1);
        $this->createJobSeekerFollowup($jobSeeker, $nextMonthDate->toDateString(), auth()->id());
        $this->createJobSeekerFollowup($jobSeeker, $nextMonthDate->toDateString(), auth()->id());
        $this->createJobSeekerFollowup($jobSeeker, $nextMonthDate->toDateString());

        $this->createJobSeekerFollowup($jobSeeker, now()->startOfMonth()->addDay(6)->toDateString(), auth()->id());


        $this->json('get', route('api.upcoming-followups.counts'), [
            'followup_date' => $nextMonthDate->format('Y-m')
        ])->assertJson([
            'data' => [
                [
                    'followup_date' => $nextMonthDate->toDateString(),
                    'followup_count' => 2,
                ],
            ]
        ])->assertSuccessful();
    }

    protected function createJobSeekerFollowup($jobSeeker, $date, $userId = null)
    {
        $jobSeeker->followups()->create([
            'followup_period' => 'monthly',
            'type' => 'scheduled',
            'followup_date' => $date,
            'user_id' => $userId
        ]);
    }
}
