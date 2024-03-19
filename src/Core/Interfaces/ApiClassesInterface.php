<?php

namespace Medboubazine\Telegram\Core\Interfaces;

use Medboubazine\Telegram\Auth\Credentials;

interface ApiClassesInterface
{
    /**
     * constructor
     *
     * @param Credentials $credentials
     */
    public  function __construct(Credentials $credentials);
}
