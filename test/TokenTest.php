<?php

namespace test\eLife\Hypothesis;

use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Request;

final class TokenTest extends PHPUnit_Framework_TestCase
{
    use SilexTestCase;

    /**
     * @test
     */
    public function it_provides_a_list_of_public_annotations()
    {
        $response = $this->getApp()->handle(Request::create(
            '/token',
            'POST',
            [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => 'jwt',
            ]
        ));

        $this->assertSame(
            200,
            $response->getStatusCode(),
            var_export($response->getContent(), true)
        );
        $body = json_decode($response->getContent(), true);
        $this->assertEquals(
            [
                'access_token' => 'access_token_generated',
                'token_type' => 'Bearer',
                'expires_in' => 3600.0,
                'refresh_token' => 'refresh_token_generated',
            ],
            $body
        );
    }
}
