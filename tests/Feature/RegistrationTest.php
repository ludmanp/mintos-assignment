<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testSuccess(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ];
        Notification::fake();

        $response = $this->post('/register', $data);

        $response->assertStatus(302);
        $response->assertHeader('location', rtrim(config('app.url'), '/') . '/login');

        $user = User::query()->where('email', $email)->first();
        $this->assertNotNull($user);
        $this->assertNull($user->email_verified_at);

        Notification::assertSentTo($user, VerifyEmail::class, function ($notification, $channels) use ($user) {
            return true;
        });
    }

    public function testDuplicateEmailFail(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ];
        User::factory()->create(['email' => $email, 'password' => $password]);

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['email'  => 'This email has already been taken']);
    }

    public function testDifferentPasswordsFail(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $password_confirmation = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password'  => 'The password field confirmation does not match.']);
    }

    public function testValidateEmailRequestSuccess(): void
    {
        $email = $this->faker->email;
        $data = [
            'email' => $email,
        ];
        $response = $this->post('/validate-email', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);
    }

    public function testValidateEmailRequestFail(): void
    {
        $email = $this->faker->email;
        $data = [
            'email' => $email,
        ];
        User::factory()->create(['email' => $email, 'password' => $this->faker->password]);
        $response = $this->post('/validate-email', $data);

        $response->assertSessionHasErrors(['email'  => 'This email has already been taken']);
    }
}
