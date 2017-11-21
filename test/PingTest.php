<?php

namespace test\eLife\Hypothesis;

use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Request;

final class PingTest extends PHPUnit_Framework_TestCase
{
    use SilexTestCase;

    /**
     * @test
     */
    public function it_can_be_pinged()
    {
        $response = $this->getApp()->handle(Request::create('/ping'));

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('pong', $response->getContent());
    }
}
