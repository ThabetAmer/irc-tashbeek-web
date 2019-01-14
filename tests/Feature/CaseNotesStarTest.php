<?php

namespace Tests\Feature;

use App\Models\JobSeeker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseNotesStarTest extends TestCase
{

    use RefreshDatabase;

    public function test_only_authorized_can_star_a_case_note()
    {
        $this->json('post', route('api.case-notes.star', ['job-seeker', 1, 1]))
            ->assertStatus(401);
    }


    public function test_it_stars_a_note()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $note = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id()
        ]);

        $this->json('post', route('api.case-notes.star', ['job-seeker', 1, 1]))
            ->assertJson([
                'note' => [
                    'is_starred' => true
                ]
            ])
            ->assertStatus(200);

        $this->assertTrue($note->fresh()->is_starred);
    }

    public function test_it_toggle_star()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $note = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => true
        ]);

        $this->json('post', route('api.case-notes.star', ['job-seeker', 1, 1]))
            ->assertStatus(200)
            ->assertJson([
                'note' => [
                    'is_starred' => false
                ]
            ]);

        $this->assertFalse($note->fresh()->is_starred);
    }


    public function test_it_can_star_one_note_only()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $note = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => true
        ]);

        $note2 = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => false
        ]);

        $note3 = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => true
        ]);

        $this->json('post', route('api.case-notes.star', ['job-seeker', $jobSeeker->id, $note2->id]))
            ->assertStatus(200)
            ->assertJson([
                'note' => [
                    'is_starred' => true
                ]
            ]);

        $this->assertTrue($note2->fresh()->is_starred);
        $this->assertFalse($note->fresh()->is_starred);
        $this->assertFalse($note3->fresh()->is_starred);
    }

    public function test_it_can_star_one_note_only_when_its_a_star()
    {
        $this->loginApi();

        $this->syncStructure('job-seeker');

        $jobSeeker = factory(JobSeeker::class)->create();

        $note = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => true
        ]);

        $note2 = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => true
        ]);

        $note3 = $jobSeeker->notes()->create([
            'note' => 'hello',
            'user_id' => auth()->id(),
            'is_starred' => true
        ]);

        $this->json('post', route('api.case-notes.star', ['job-seeker', $jobSeeker->id, $note2->id]))
            ->assertStatus(200)
            ->assertJson([
                'note' => [
                    'is_starred' => false
                ]
            ]);

        $this->assertFalse($note2->fresh()->is_starred);
        $this->assertTrue($note->fresh()->is_starred);
        $this->assertTrue($note3->fresh()->is_starred);
    }
}
