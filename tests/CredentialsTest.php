<?php

namespace MedboubazineTests\Telegram;

use Medboubazine\Telegram\Auth\Credentials;
use PHPUnit\Framework\TestCase;

final class CredentialsTest extends TestCase
{
    /**
     * Test
     *
     */
    public function testAuthCredentialsForLiveMode()
    {
        $credentials = new Credentials([
            "token" => "*********************",
        ]);
        $this->assertIsString($credentials->token);
    }
}
