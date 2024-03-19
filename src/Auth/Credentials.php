<?php

namespace Medboubazine\Telegram\Auth;

use Medboubazine\Telegram\Exceptions\ValidationException;
use Medboubazine\Telegram\Validation\Auth\CredentialsValidation;

final class Credentials
{
    /**
     * Merchant API Token
     *
     * @var string
     */
    public string $token;

    public function __construct(array $configs)
    {
        $this->validation($configs);

        $this->token = $configs["token"];
    }
    /**
     * Validate credentials
     *
     * @param array $attributes
     * @return boolean
     */
    public function validation(array $attributes): bool
    {

        $validation = new CredentialsValidation($attributes);

        if (!$validation->passed()) {
            ValidationException::message("Authentication Credentials", $validation->errors(), 422);
        }

        return $validation->passed();
    }
}
