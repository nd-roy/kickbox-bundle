<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Tests\Exception;

use Andi\KickBoxBundle\Exception\KickBoxApiException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class KickBoxApiExceptionTest
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * @see Andi\KickBoxBundle\Exception\KickBoxApiException
 */
class KickBoxApiExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $httpResponse = new Response('expectedResponse');
        $e = new KickBoxApiException('test', new Request('', ''), $httpResponse);
        $this->assertEquals(
            'An error occurred during the api call : test',
            $e->getMessage(),
            'default message should be returned.'
        );

        $this->assertEquals($httpResponse->getBody(), $e->getResponse()->getBody());
    }
}
