<?php

namespace test\eLife\Hypothesis;

use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Request;

final class UsersTest extends PHPUnit_Framework_TestCase
{
    use SilexTestCase;

    /**
     * @test
     */
    public function it_provides_a_record_for_the_user()
    {
        $response = $this->getApp()->handle(Request::create(
            '/users',
            'POST',
            [],
            [],
            [],
            array(
                'CONTENT_TYPE' => 'application/json',
            ),
            json_encode([
                'authority' => 'example.com',
                'username' => 'abcdef',
                'email' => 'abcdef@hypothesis.elifesciences.org',
                'display_name' => 'Josiah Carberry',
            ])
        ));

        $this->assertSame(
            200,
            $response->getStatusCode(),
            var_export($response->getContent(), true)
        );
        $body = json_decode($response->getContent(), true);
        $this->assertEquals(
            [
                'authority' => 'example.com',
                'username' => 'abcdef',
                'email' => 'abcdef@hypothesis.elifesciences.org',
                'display_name' => 'Josiah Carberry',
                'userid' => 'hypothesis-id-abcdef',
            ],
            $body
        );
    }
}
