<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->be($user);

        $this->post(route('logout'))
            ->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
