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

    /**
     * Get Balance.
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set Balance.
     *
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get ResponseTime.
     *
     * @return int
     */
    public function getResponseTime()
    {
        return $this->responseTime;
    }

    /**
     * Set ResponseTime.
     *
     * @param int $responseTime
     */
    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;
    }

    /**
     * Get Result.
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set Result.
     *
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Get Reason.
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set Reason.
     *
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * Is Role.
     *
     * @return boolean
     */
    public function isRole()
    {
        return $this->role;
    }

    /**
     * Set Role.
     *
     * @param boolean $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Is Free.
     *
     * @return boolean
     */
    public function isFree()
    {
        return $this->free;
    }

    /**
     * Set Free.
     *
     * @param boolean $free
     */
    public function setFree($free)
    {
        $this->free = $free;
    }

    /**
     * Is Disposable.
     *
     * @return boolean
     */
    public function isDisposable()
    {
        return $this->disposable;
    }

    /**
     * Set Disposable.
     *
     * @param boolean $disposable
     */
    public function setDisposable($disposable)
    {
        $this->disposable = $disposable;
    }

    /**
     * Is AcceptAll.
     *
     * @return boolean
     */
    public function isAcceptAll()
    {
        return $this->acceptAll;
    }

    /**
     * Set AcceptAll.
     *
     * @param boolean $acceptAll
     */
    public function setAcceptAll($acceptAll)
    {
        $this->acceptAll = $acceptAll;
    }

    /**
     * Get Suggestion.
     *
     * @return null|string
     */
    public function getSuggestion()
    {
        return $this->suggestion;
    }

    /**
     * Set Suggestion.
     *
     * @param null|string $suggestion
     */
    public function setSuggestion($suggestion)
    {
        $this->suggestion = $suggestion;
    }

    /**
     * Get Sendex.
     *
     * @return float
     */
    public function getSendex()
    {
        return $this->sendex;
    }

    /**
     * Set Sendex.
     *
     * @param float $sendex
     */
    public function setSendex($sendex)
    {
        $this->sendex = $sendex;
    }

    /**
     * Get Email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Email.
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get User.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User.
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get Domain.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set Domain.
     *
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Is Success.
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * Set Success.
     *
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }
}
