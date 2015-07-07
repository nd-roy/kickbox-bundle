<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Exception;

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception thrown if a kickbox api call has not a 2xx http status code.
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 */
class KickBoxApiException extends BadResponseException
{
    const MESSAGE = 'An error occurred during the api call : ';

    /**
     * {@inheritdoc}
     */
    public function __construct(
        $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null
    ) {
        parent::__construct(self::MESSAGE . $message, $request, $response, $previous);
    }
}
