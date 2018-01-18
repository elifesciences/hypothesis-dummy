<?php

namespace test\eLife\Hypothesis;

use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Request;

final class SearchTest extends PHPUnit_Framework_TestCase
{
    use SilexTestCase;

    /**
     * @test
     */
    public function it_provides_a_list_of_public_annotations()
    {
        $response = $this->getApp()->handle(Request::create(
            '/search',
            'GET',
            [
                'user' => 'jcarberry',
                'group' => '',
                'offset' => 0,
                'limit' => 20,
                'order' => 'desc',
                'sort' => 'updated',
            ]
        ));

        $this->assertSame(
            200,
            $response->getStatusCode(),
            var_export($response->getContent(), true)
        );
        $body = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('total', $body);
        $this->assertArrayHasKey('rows', $body);
        $this->assertCount(2, $body['rows']);
        foreach ($body['rows'] as $row) {
            $this->assertArrayHasKey('id', $row);
            $this->assertArrayHasKey('text', $row);
            $this->assertArrayHasKey('created', $row);
            $this->assertArrayHasKey('updated', $row);
            $this->assertArrayHasKey('document', $row);
            $this->assertArrayHasKey('title', $row['document']);
            $this->assertInternalType('array', $row['document']['title']);
            $this->assertArrayHasKey('target', $row);
            if (isset($row['target']['selector'])) {
                $this->assertInternalType('array', $row['target']['selector']);
            }
            $this->assertArrayHasKey('uri', $row);
            $this->assertArrayHasKey('permissions', $row);
            $this->assertArrayHasKey('read', $row['permissions']);
            $this->assertInternalType('array', $row['permissions']['read']);
        }
    }
}
