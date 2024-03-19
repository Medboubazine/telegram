<?php

namespace Medboubazine\Telegram\Core\Abstracts;

use Medboubazine\Telegram\Auth\Credentials;

abstract class ApiClassesAbstract
{
    /**
     * Credentials
     *
     * @var Credentials
     */
    protected Credentials $credentials;
    /**
     * constructor
     *
     * @param Credentials $credentials
     */
    public  function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }
}
