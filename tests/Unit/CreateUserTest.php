<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;


    public function test_name_is_required()
    {

        $response = $this->post('/user', []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['name']);

    }


    public function test_email_is_required()
    {
        $response = $this->post('/user', []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['email']);
    }


    public function test_email_is_unique_in_create()
    {
        factory(User::class)->create(['email' => 'sehweil@gmail.com']);

        $this->json('POST', '/user', ['email' => 'sehweil@gmail.com'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

    }

    public function test_password_is_required()
    {

        $this->json('POST', '/user', ['password' => null])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

    }


    public function test_password_confirmation_is_required()
    {

        $this->json('POST', '/user', ['password_confirmation' => null])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    public function test_password_confirmation_and_password_not_matched()
    {

        $this->json('POST', '/user', [
            'password' => 'password_1',
            'password_confirmation' => 'password_2',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }


    public function test_check_if_password_saved_encrypted()
    {

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',

        ];

        $this->json('POST', '/user', $data);

        $user = User::find(1);

        $this->assertTrue(Hash::check($data['password'], $user->password));
    }

    public function test_profile_picture_uploaded_successfully()
    {
        Storage::fake('upload');

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',
            'profile_picture' => UploadedFile::fake()->image('avatar.jpg')
        ];

        $this->json('POST', '/user', $data);
        Storage::disk('upload')->assertExists('/1/avatar.jpg');

    }


    public function test_profile_picture_if_empty()
    {
        Storage::fake('upload');

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',
            'profile_picture' => null
        ];

        $this->json('POST', '/user', $data);

        $user = User::find(1);
        $this->assertNull($user->profile_picture);
    }


    public function test_create_user()
    {
        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',

        ];

        $response = $this->json('POST', '/user', $data);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => true,
            ]);


        $this->assertCount(1, User::all());
        $this->assertDatabaseHas('users', array_except($data, ['password_confirmation', 'password']));
    }

}
