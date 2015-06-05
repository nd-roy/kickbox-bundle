<?php

/*
 * This file is part of the kickbox-bundle Project.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Exception;

use Exception;

/**
 * Class InvalidContentException
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
 */
class InvalidContentException extends \InvalidArgumentException
{
    const MESSAGE = 'The expected parameters are missing. Parameters : ';

    /**
     * {@inheritdoc}
     */
    public function __construct(array $expectedParameters, $code = 0, Exception $previous = null)
    {
        $message = self::MESSAGE . implode(', ', $expectedParameters);

        parent::__construct($message, $code, $previous);
    }
}
