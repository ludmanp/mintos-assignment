<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RssReaderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Traits\FakeXmlTrait;

class IndexTest extends TestCase
{
    use FakeXmlTrait;

    public function testNoAuthFail(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));;
    }

    public function testSuccess(): void
    {
        $user = User::factory()->create();
        $this->be($user);

        Cache::clear();
        $this->partialMock(RssReaderService::class, function (MockInterface $mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getXML')->once()
                ->andReturn($this->getXML());
        });

        $response = $this->get('/');

        $response->assertStatus(200);
    }


}
