<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Tests\Factory;

use Andi\KickBoxBundle\Exception\InvalidContentException;
use Andi\KickBoxBundle\Factory\ResponseFactory;
use Andi\KickBoxBundle\Http\Response;

/**
 * Class ResponseFactoryTest
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * @see    Andi\KickBoxBundle\Factory\ResponseFactory
 */
class ResponseFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    public static $goodHeaders = [
        'X-Kickbox-Balance'       => [0 => 1],
        'X-Kickbox-Response-Time' => [0 => 5],
    ];

    /**
     * @var array
     */
    public static $goodParameters = [
        'domain'       => 2,
        'email'        => 3,
        'reason'       => 4,
        'result'       => 6,
        'did_you_mean' => 7,
        'sendex'       => 8,
        'user'         => 9,
        'accept_all'   => true,
        'free'         => false,
        'role'         => true,
        'success'      => false,
        'disposable'   => true,
    ];

    /**
     * @dataProvider getBadValueProvider
     *
     * @param array $headers
     * @param array $parameters
     */
    public function testFactoryWithBadValue(array $headers, array $parameters)
    {
        $this->setExpectedException(InvalidContentException::class);
        $factory = new ResponseFactory();
        $factory->createResponse($headers, $parameters);
    }

    public function testFactoryWithGoodValue()
    {
        $factory  = new ResponseFactory();
        $response = $factory->createResponse(self::$goodHeaders, self::$goodParameters);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(1, $response->getBalance());
        $this->assertEquals(2, $response->getDomain());
        $this->assertEquals(3, $response->getEmail());
        $this->assertEquals(4, $response->getReason());
        $this->assertEquals(5, $response->getResponseTime());
        $this->assertEquals(6, $response->getResult());
        $this->assertEquals(7, $response->getSuggestion());
        $this->assertEquals(8, $response->getSendex());
        $this->assertEquals(9, $response->getUser());

        $this->assertTrue($response->isAcceptAll());
        $this->assertTrue($response->isRole());
        $this->assertTrue($response->isDisposable());

        $this->assertNotTrue($response->isFree());
        $this->assertNotTrue($response->isSuccess());
    }

    /**
     * @return array
     */
    public function getBadValueProvider()
    {
        return [
            [
                self::$goodHeaders,
                [
                    'bad value' => '',
                ],
            ],
            [
                [
                    'X--Balance'       => [0 => ''],
                    'X--Response-Time' => [0 => ''],
                ],
                self::$goodParameters,
            ]
        ];
    }
}
