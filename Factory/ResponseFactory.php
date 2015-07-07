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
use Andi\KickBoxBundle\Exception\InvalidContentException;

/**
 * Kickbox Response Factory.
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 */
class ResponseFactory
{
    /**
     * @var array
     */
    protected $exceptedHeaders = [
        'X-Kickbox-Balance',
        'X-Kickbox-Response-Time',
    ];

    /**
     * @var array
     */
    protected $expectedParameters = [
        'result',
        'reason',
        'role',
        'free',
        'disposable',
        'accept_all',
        'did_you_mean',
        'sendex',
        'email',
        'user',
        'domain',
        'success',
    ];

    /**
     * Create a KickBox Response according to an api call.
     *
     * @param array $headers    HTTP Headers of the call.
     * @param array $parameters Json Parameters of the call.
     *
     * @return Response A Kickbox response instance.
     */
    public function createResponse(array $headers, array $parameters)
    {
        $response = new Response();

        $this->checkExpectedValues($this->exceptedHeaders, $headers);

        if (isset($headers['X-Kickbox-Balance'][0])) {
            $response->setBalance($headers['X-Kickbox-Balance'][0]);
        }
        if (isset($headers['X-Kickbox-Response-Time'][0])) {
            $response->setResponseTime($headers['X-Kickbox-Response-Time'][0]);
        }

        $this->checkExpectedValues($this->expectedParameters, $parameters);

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

    /**
     * Check if the expected values are in the array.
     *
     * @param $expectedValues
     * @param $array
     *
     * @return bool
     */
    protected function checkExpectedValues($expectedValues, $array)
    {
        if (count(array_intersect_key($array, array_flip($expectedValues))) != count($expectedValues)) {
            throw new InvalidContentException($expectedValues);
        }
    }
}
