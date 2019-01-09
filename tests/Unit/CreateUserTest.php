<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;


    public function test_name_is_required()
    {
        $this->loginApi();

        $response = $this->post('api/users', []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['name']);

    }


    public function test_email_is_required()
    {
        $this->loginApi();

        $response = $this->post('api/users', []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['email']);
    }


    public function test_email_is_unique_in_create()
    {
        $this->loginApi();

        factory(User::class)->create(['email' => 'sehweil@gmail.com']);

        $this->json('POST', 'api/users', ['email' => 'sehweil@gmail.com'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

    }

    public function test_password_is_required()
    {
        $this->loginApi();

        $this->json('POST', 'api/users', ['password' => null])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

    }


    public function test_password_confirmation_is_required()
    {
        $this->loginApi();

        $this->json('POST', 'api/users', ['password_confirmation' => null])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    public function test_password_confirmation_and_password_not_matched()
    {
        $this->loginApi();

        $this->json('POST', 'api/users', [
            'password' => 'password_1',
            'password_confirmation' => 'password_2',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }


    public function test_check_if_password_saved_encrypted()
    {
        $this->loginApi();

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',

        ];

        $this->json('POST', 'api/users', $data);

        $user = User::query()->where('email', $data['email'])->first();  // instead of using User::find(2)

        $this->assertNotNull($user);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }

    public function test_profile_picture_uploaded_successfully()
    {

        $this->loginApi();

        Storage::fake('upload');

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',
            'profile_picture' => UploadedFile::fake()->image('avatar.jpg')
        ];

        $this->json('POST', 'api/users', $data);
        Storage::disk('upload')->assertExists('/1/avatar.jpg');

    }


    public function test_profile_picture_if_empty()
    {
        $this->loginApi();

        Storage::fake('upload');

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',
            'profile_picture' => null
        ];

        $this->json('POST', 'api/users', $data);

        $user = User::find(1);
        $this->assertNull($user->profile_picture);
    }


    public function test_create_user()
    {
        $this->loginApi();

        $data = [
            'name' => 'Mohammed',
            'email' => 'sehweil@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',

        ];

        $response = $this->json('POST', 'api/users', $data);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => true,
            ]);


        $this->assertDatabaseHas('users', array_except($data, ['password_confirmation', 'password']));
    }

    public function test_user_roles()
    {
        $this->loginApi();

        $data = [
            'name' => 'Mohammed',
            'email' => 'ali@gmail.com',
            'password' => 'sehweil',
            'password_confirmation' => 'sehweil',
            'roles' => Role::query()->take(3)->pluck('id')->toArray(),
        ];

        $response = $this->json('POST', 'api/users', $data);

        $user = User::find(2);

        $this->assertCount(3, $user->roles);

    }


}
