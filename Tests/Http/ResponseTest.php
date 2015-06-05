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

use Andi\KickBoxBundle\Http\Response;

/**
 * Response Test
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * @see    Andi\KickBoxBundle\Http\Response
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testProperties()
    {
        $response     = new Response();
        $propertyList = $this->getPropertyList();

        foreach ($propertyList as $property) {
            $this->assertTrue(property_exists($response, $property));
        }
    }

    public function testCountProperty()
    {
        $responseReflexion = new \ReflectionClass(Response::class);
        $propertyList      = $responseReflexion->getProperties();

        $this->assertEquals(count($this->getPropertyList()), count($propertyList));
    }

    /**
     * @return array
     */
    protected function getPropertyList()
    {
        return [
            'balance',
            'domain',
            'email',
            'reason',
            'responseTime',
            'result',
            'suggestion',
            'sendex',
            'user',
            'acceptAll',
            'disposable',
            'free',
            'role',
            'success',
        ];
    }
}
