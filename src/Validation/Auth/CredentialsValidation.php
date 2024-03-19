<?php

namespace Medboubazine\Telegram\Validation\Auth;

use Medboubazine\Telegram\Core\Abstracts\Validation;
use Medboubazine\Telegram\Core\Interfaces\ValidationInterface;

final class CredentialsValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "token" => "required|min:8",
        ];
    }
}
