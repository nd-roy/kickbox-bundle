<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Factory;

use Andi\KickBoxBundle\Http\Response;

class ResponseFactory
{
    /**
     * Create a KickBox Response according to an api call.
     *
     * @param array $headers    HTTP headers of the call.
     * @param array $parameters Json Parameters of the call.
     *
     * @return Response A Kickbox response instance.
     */
    public static function createResponse(array $headers, array $parameters)
    {
        $response = new Response();

        $response
            ->setBalance($headers['X-Kickbox-Balance'][0])
            ->setResponseTime($headers['X-Kickbox-Response-Time'][0]);

        $response
            ->setResult($parameters['result'])
            ->setReason($parameters['reason'])
            ->setRole($parameters['role'])
            ->setFree($parameters['free'])
            ->setDisposable($parameters['disposable'])
            ->setAcceptAll($parameters['accept_all'])
            ->setSuggestion($parameters['did_you_mean'])
            ->setSendex($parameters['sendex'])
            ->setEmail($parameters['email'])
            ->setUser($parameters['user'])
            ->setDomain($parameters['domain'])
            ->setSuccess($parameters['success'])
        ;

        return $response;
    }
}
