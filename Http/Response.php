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
 *
 * @author Abdoul Ndiaye <abdoul.nd@gmail.com>
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
     * If the email address is a role address.
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
     * get Balance.
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
     *
     * @return $this
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * get ResponseTime.
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
     *
     * @return $this
     */
    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;

        return $this;
    }

    /**
     * get Result.
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
     *
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * get Reason.
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
     *
     * @return $this
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * is Role.
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
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * is Free.
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
     *
     * @return $this
     */
    public function setFree($free)
    {
        $this->free = $free;

        return $this;
    }

    /**
     * is Disposable.
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
     *
     * @return $this
     */
    public function setDisposable($disposable)
    {
        $this->disposable = $disposable;

        return $this;
    }

    /**
     * is AcceptAll.
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
     *
     * @return $this
     */
    public function setAcceptAll($acceptAll)
    {
        $this->acceptAll = $acceptAll;

        return $this;
    }

    /**
     * get Suggestion.
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
     *
     * @return $this
     */
    public function setSuggestion($suggestion)
    {
        $this->suggestion = $suggestion;

        return $this;
    }

    /**
     * get Sendex.
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
     *
     * @return $this
     */
    public function setSendex($sendex)
    {
        $this->sendex = $sendex;

        return $this;
    }

    /**
     * get Email.
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
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * get User.
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
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * get Domain.
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
     *
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * is Success.
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
     *
     * @return $this
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }
}
