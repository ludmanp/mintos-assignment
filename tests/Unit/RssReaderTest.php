<?php

namespace Tests\Unit;

use App\Services\RssReaderService;
use Illuminate\Support\Facades\Cache;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Traits\FakeXmlTrait;

class RssReaderTest extends TestCase
{
    use FakeXmlTrait;

    public function testReadSuccess(): void
    {
        Cache::clear();
        $this->partialMock(RssReaderService::class, function (MockInterface $mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getXML')->once()
                ->andReturn($this->getXML());
        });

        app()->make(RssReaderService::class)->read();
    }

    public function testCacheSuccess(): void
    {
        Cache::put('rss::' . config('rss.url'), $this->getXML(), 10);
        $this->partialMock(RssReaderService::class, function (MockInterface $mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getXML')->never();
        });

        app()->make(RssReaderService::class)->read();
    }


}
