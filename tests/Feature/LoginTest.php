<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testSuccess(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $user = User::factory()->create(['email' => $email, 'password' => Hash::make($password), 'email_verified_at' => now()]);

        $response = $this->post('/login', $data);

        $response->assertHeader('location', rtrim(config('app.url'), '/'));
        $this->assertAuthenticatedAs($user);
    }

    public function testUnknownUserFailed(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $password,
        ];

        $response = $this->post('/login', $data);

        $response->assertSessionHasErrors(['email' => 'Email or password is not valid']);
    }

    public function testNotConfirmedEmailFailed(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        User::factory()->create(['email' => $email, 'password' => Hash::make($password), 'email_verified_at' => null]);

        $response = $this->post('/login', $data);

        $response->assertSessionHasErrors(['email' => 'Email or password is not valid']);
    }

    public function testWrangPasswordFailed(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $data = [
            'email' => $email,
            'password' => $this->faker->password,
        ];
        User::factory()->create(['email' => $email, 'password' => Hash::make($password), 'email_verified_at' => null]);

        $response = $this->post('/login', $data);

        $response->assertSessionHasErrors(['email' => 'Email or password is not valid']);
    }
}
