<?php

namespace Andi\KickBoxBundle\Exception;

/**
 * Class Empty Content Exception
 */
class EmptyContentException extends \RuntimeException
{
    const MESSAGE = 'The status is valid but the response is empty.';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
