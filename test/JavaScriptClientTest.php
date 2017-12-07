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
    public function it_provides_a_list_of_urls_to_call()
    {
        $response = $this->getApp()->handle(Request::create(
            '/',
            'GET',
            [],
            [],
            [],
            [
                'HTTP_HOST' => 'demo--hypothesis-dummy.elifesciences.org',
                'HTTPS' => 'on',
            ]
        ));

        $this->assertSame(
            200,
            $response->getStatusCode(),
            var_export($response->getContent(), true)
        );
        $body = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $body);
        $this->assertEquals(
            'Annotator Store API',
            $body['message']
        );
        $this->assertArrayHasKey('links', $body);
        $this->assertArrayHasKey('profile', $body['links']);
        $this->assertArrayHasKey('read', $body['links']['profile']);
        $this->assertArrayHasKey('url', $body['links']['profile']['read']);
        $this->assertEquals('https://demo--hypothesis-dummy.elifesciences.org/profile', $body['links']['profile']['read']['url']);
    }

    /**
     * @test
     */
    public function it_provides_a_list_of_links_for_the_user()
    {
        $response = $this->getApp()->handle(Request::create('/links'));

        $this->assertSame(
            200,
            $response->getStatusCode(),
            var_export($response->getContent(), true)
        );
        $body = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('account.settings', $body);
    }

    /**
     * @test
     */
    public function it_provides_a_fake_token_to_anyone()
    {
        $response = $this->getApp()->handle(Request::create('/token'));
        // TODO: reduce duplication of assertions
        $this->assertSame(
            200,
            $response->getStatusCode(),
            var_export($response->getContent(), true)
        );
        $body = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('access_token', $body);
    }
}
