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

/**
 * Class Empty Content Exception
 */
class EmptyContentException extends \RuntimeException
{
    const MESSAGE = 'The status is valid but the response is empty.';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = self::MESSAGE, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
