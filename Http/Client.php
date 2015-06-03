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

use Andi\KickBoxBundle\Exception\EmptyContentException;
use Andi\KickBoxBundle\Exception\KickBoxApiException;
use Andi\KickBoxBundle\Factory\ResponseFactory;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\ResponseInterface;

/**
 * The Kickbox http client that verify email addresses.
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 */
class Client
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * @var string
     */
    protected $endPoint;

    /**
     * @var string
     */
    protected $key;

    /**
     * Construct.
     *
     * @param HttpClient      $client          A Guzzle client instance.
     * @param ResponseFactory $responseFactory A Response Factory instance.
     * @param string          $endPoint        A KickBox API endpoint.
     * @param string          $key             An Api key generated in kickbox.io.
     */
    public function __construct(HttpClient $client, ResponseFactory $responseFactory, $endPoint, $key)
    {
        $this->client          = $client;
        $this->responseFactory = $responseFactory;
        $this->endPoint        = $endPoint;
        $this->key             = $key;
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
            /* @var ResponseInterface $exceptionResponse */
            $exceptionResponse = $exception->getResponse();
            $errorContent      = $exceptionResponse->json();

            throw new KickBoxApiException(
                $errorContent['message'],
                $exception->getRequest(),
                $exception->getResponse(),
                $exception
            );
        }

        $parameters = $httpResponse->json();

        if (empty($parameters)) {
            throw new EmptyContentException();
        }

        return $this->responseFactory->createResponse($httpResponse->getHeaders(), $parameters);
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
        return [
            'query' => [
                'email'   => $email,
                'apikey'  => $this->key,
                'timeout' => $timeout,
            ]
        ];
    }
}
