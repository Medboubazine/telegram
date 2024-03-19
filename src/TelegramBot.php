<?php

namespace Medboubazine\Telegram;

use Medboubazine\Telegram\Api\GetMe;
use Medboubazine\Telegram\Api\Messages;
use Medboubazine\Telegram\Api\Updates;
use Medboubazine\Telegram\Api\Webhook;
use Medboubazine\Telegram\Auth\Credentials;

final class TelegramBot
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
    /**
     * GetMe API
     *
     * @return GetMe
     */
    public function get_me(): GetMe
    {
        return new GetMe($this->credentials);
    }
    /**
     * Updates
     *
     * @return Updates
     */
    public function updates(): Updates
    {
        return new Updates($this->credentials);
    }
    /**
     * Webhook
     *
     * @return Webhook
     */
    public function webhook(): Webhook
    {
        return new Webhook($this->credentials);
    }
    /**
     * Mesages
     *
     * @return Messages
     */
    public function messages(): Messages
    {
        return new Messages($this->credentials);
    }
}
