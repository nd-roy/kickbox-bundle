<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Tests\Http;

use Andi\KickBoxBundle\Exception\EmptyContentException;
use Andi\KickBoxBundle\Exception\KickBoxApiException;
use Andi\KickBoxBundle\Factory\ResponseFactory;
use Andi\KickBoxBundle\Http\Client;
use Andi\KickBoxBundle\Http\Response;
use Andi\KickBoxBundle\Tests\Factory\ResponseFactoryTest;
use GuzzleHttp\Psr7\Response as HttpResponse;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use Phake;
use GuzzleHttp\Client as HttpClient;

/**
 * Class ClientTest
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * @see    Andi\KickBoxBundle\Http\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpClient|\Phake_IMock
     */
    protected $httpClient;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * @{@inheritdoc}
     */
    protected function setUp()
    {
        $this->httpClient      = Phake::mock(HttpClient::class);
        $this->responseFactory = new ResponseFactory();
    }

    public function testVerify()
    {
        Phake::when($this->httpClient)->get(
            'my_end_point',
            [
                'query' => [
                    'email'   => 'ab@cd.com',
                    'apikey'  => 'my_key',
                    'timeout' => 7000,
                ]
            ]
        )->thenReturn($this->getResponse());

        $client = new Client($this->httpClient, $this->responseFactory, 'my_end_point', 'my_key');

        $this->assertInstanceOf(Response::class, $client->verify('ab@cd.com', 7000));
    }

    public function testKickboxApiException()
    {
        Phake::when($this->httpClient)->get(Phake::anyParameters())->thenThrow(
            new KickBoxApiException('expectedMessage', new Request('GET', 'error'), $this->getErrorResponse())
        );

        $this->setExpectedException(
            KickBoxApiException::class,
            'An error occurred during the api call : exception message'
        );

        $client = new Client($this->httpClient, $this->responseFactory, '', '');
        $client->verify('');
    }

    public function testEmptyContentException()
    {
        Phake::when($this->httpClient)->get(Phake::anyParameters())->thenReturn(new HttpResponse(400));

        $this->setExpectedException(
            EmptyContentException::class
        );

        $client = new Client($this->httpClient, $this->responseFactory, '', '');
        $client->verify('');
    }

    /**
     * @return HttpResponse
     */
    protected function getResponse()
    {
        return new HttpResponse(
            200,
            ResponseFactoryTest::$goodHeaders,
            json_encode(ResponseFactoryTest::$goodParameters)
        );
    }

    /**
     * @return HttpResponse
     */
    protected function getErrorResponse()
    {
        return new HttpResponse(
            500,
            [],
            json_encode(['message' => 'exception message'])
        );
    }
}
