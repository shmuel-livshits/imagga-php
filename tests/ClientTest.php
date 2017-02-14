<?php

namespace Fab\Imagga\Tests;

use Mockery;
use GuzzleHttp\Client as HttpClient;
use Fab\Imagga\Client;

class ClientTest extends TestCase
{
    /** @test */
    function can_instantiate_client()
    {
        $httpClient = $this->getHttpClientMock();

        $client = new Client($httpClient, 'api-key', 'api-secret');

        $this->assertInstanceOf(Client::class, $client);
    }

    /** @test */
    function can_get_tags_for_an_image_url()
    {
        // Arrange
        $httpClient = $this->getHttpClientMock();

        $httpClient
            ->shouldReceive('request')
            ->with('GET', 'http://api.imagga.com/v1/tagging', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'auth' => ['api-key', 'api-secret'],
                'query' => [
                    'url' => 'image-url',
                    'version' => '2'
                ]
            ])
            ->andReturn($httpClient);

        $httpClient
            ->shouldReceive('getBody')
            ->andReturn(json_encode(['foo' => 'bar']));

        // Actd
        $response = (new Client($httpClient, 'api-key', 'api-secret'))->tags('image-url');

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertEquals([
            'foo' => 'bar'
        ], $response);
    }

    /** @test */
    function can_pass_options_when_tagging_an_image()
    {
        // Arrange
        $httpClient = $this->getHttpClientMock();

        $httpClient
            ->shouldReceive('request')
            ->with('GET', 'http://api.imagga.com/v1/tagging', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'auth' => ['api-key', 'api-secret'],
                'query' => [
                    'url' => 'image-url',
                    'version' => '2',
                    'language' => 'fr',
                ]
            ])
            ->andReturn($httpClient);

        $httpClient
            ->shouldReceive('getBody')
            ->andReturn(json_encode(['foo' => 'bar']));

        // Act
        $response = (new Client($httpClient, 'api-key', 'api-secret'))->tags('image-url', [
            'language' => 'fr',
        ]);

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertEquals([
            'foo' => 'bar'
        ], $response);
    }

    /** @test */
    function can_get_colors_of_images()
    {
        // Arrange
        $httpClient = $this->getHttpClientMock();

        $httpClient
            ->shouldReceive('request')
            ->with('GET', 'http://api.imagga.com/v1/colors', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'auth' => ['api-key', 'api-secret'],
                'query' => [
                    'url' => 'image-url',
                ]
            ])
            ->andReturn($httpClient);

        $httpClient
            ->shouldReceive('getBody')
            ->andReturn(json_encode(['foo' => 'bar']));

        // Act
        $response = (new Client($httpClient, 'api-key', 'api-secret'))->extractColors('image-url');

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertEquals([
            'foo' => 'bar'
        ], $response);
    }

    /** @test */
    function can_pass_options_when_get_colors_of_an_image()
    {
        // Arrange
        $httpClient = $this->getHttpClientMock();

        $httpClient
            ->shouldReceive('request')
            ->with('GET', 'http://api.imagga.com/v1/colors', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'auth' => ['api-key', 'api-secret'],
                'query' => [
                    'url' => 'image-url',
                    'extract_overall_colors' => '0',
                ]
            ])
            ->andReturn($httpClient);

        $httpClient
            ->shouldReceive('getBody')
            ->andReturn(json_encode(['foo' => 'bar']));

        // Act
        $response = (new Client($httpClient, 'api-key', 'api-secret'))->extractColors('image-url', [
            'extract_overall_colors' => '0',
        ]);

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertEquals([
            'foo' => 'bar'
        ], $response);
    }

    private function getHttpClientMock()
    {
        return Mockery::mock(HttpClient::class);
    }
}
