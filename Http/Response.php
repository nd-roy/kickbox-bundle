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

/**
 * The response content of a Kickbox Request.
 */
class Response
{
    /**
     * The remaining credit balance (Daily + On Demand).
     *
     * @var float
     */
    protected $balance;

    /**
     * The elapsed time (in milliseconds) it took Kickbox to process the request.
     *
     * @var int
     */
    protected $responseTime;

    /**
     * The verification result: deliverable, undeliverable, risky, unknown
     *
     * @var string
     */
    protected $result;

    /**
     * The reason for the result.
     *
     * @var string
     */
    protected $reason;

    /**
     * If the email address is a role address
     *
     * @var boolean
     */
    protected $role;

    /**
     * If the email address uses a free email service like gmail.com or yahoo.com.
     *
     * @var boolean
     */
    protected $free;

    /**
     * If the email address uses a disposable domain like trashmail.com or mailinator.com.
     *
     * @var boolean
     */
    protected $disposable;

    /**
     * If the email was accepted, but the domain appears to accept all emails addressed to that domain.
     *
     * @var boolean
     */
    protected $acceptAll;

    /**
     * @see did_you_mean <http://docs.kickbox.io/v2.0/docs/using-the-api>
     *
     * Returns a suggested email if a possible spelling error was detected.
     *
     * @var string|null
     */
    protected $suggestion;

    /**
     * A quality score of the provided email address ranging between 0 (no quality) and 1 (perfect quality).
     *
     * @var float
     */
    protected $sendex;

    /**
     * Returns a normalized version of the provided email address.
     *
     * @var string
     */
    protected $email;

    /**
     * The user (a.k.a local part) of the provided email address. (bob@example.com -> bob).
     *
     * @var string
     */
    protected $user;

    /**
     * The domain of the provided email address.
     *
     * @var string
     */
    protected $domain;

    /**
     * If the API request was successful.
     *
     * @var boolean
     */
    protected $success;
}
