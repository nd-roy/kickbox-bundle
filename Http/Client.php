<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Http;

use Andi\KickBoxBundle\Exception\KickBoxApiException;
use Andi\KickBoxBundle\Factory\ResponseFactory;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

/**
 * The Kickbox http client that verify email addresses.
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 */
class Client
{
    /**
     * @var string
     */
    protected $endPoint;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Construct.
     *
     * @param string $endPoint A KickBox API endpoint.
     * @param string $key      An Api key generated in kickbox.io.
     */
    public function __construct($endPoint, $key)
    {
        $this->endPoint = $endPoint;
        $this->key      = $key;
        $this->client   = new HttpClient();
    }

    /**
     * Call the Api to validate one specific email address.
     *
     * @param string $email    The email address to be verified
     * @param int    $timeout  Maximum time, in milliseconds, for the API to complete a verification request.
     *
     * @return Response     A Kickbox response instance.
     */
    public function verify($email, $timeout = 6000)
    {
        try {
            $httpResponse = $this->client->get($this->endPoint, $this->getQueryParameters($email, $timeout));
        } catch (RequestException $exception) {
            $errorContent = $exception->getResponse()->json();

            throw new KickBoxApiException(
                $errorContent['message'],
                $exception->getRequest(),
                $exception->getResponse(),
                $exception
            );
        }

        return ResponseFactory::createResponse($httpResponse->getHeaders(), $httpResponse->json());
    }

    /**
     * Return the query parameters for a kickbox api call.
     *
     * @param string $email    The email address.
     * @param int    $timeout  Time in milliseconds.
     *
     * @return array The query parameters.
     */
    protected function getQueryParameters($email, $timeout = 6000)
    {
        return array(
            'query' => array(
                'email'   => $email,
                'apikey'  => $this->key,
                'timeout' => $timeout,
            )
        );
    }
}
