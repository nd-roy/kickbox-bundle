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

use Andi\KickBoxBundle\Exception\EmptyContentException;

/**
 * Class EmptyContentExceptionTest
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * @see Andi\KickBoxBundle\Exception\EmptyContentException
 */
class EmptyContentExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionWithMessage()
    {
        $message = 'message';
        $e       = new EmptyContentException($message, 500);
        $this->assertEquals(
            $message,
            $e->getMessage(),
            'The message should be returned.'
        );

        $this->assertEquals(500, $e->getCode());
    }

    public function testExceptionWithoutMessage()
    {
        $e = new EmptyContentException();
        $this->assertEquals(
            'The status is valid but the response is empty.',
            $e->getMessage(),
            'default message should be returned.'
        );

        $this->assertEquals(0, $e->getCode());
    }
}
