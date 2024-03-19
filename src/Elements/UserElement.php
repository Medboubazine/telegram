<?php

namespace Medboubazine\Telegram\Elements;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class UserElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        ?string $username,
        ?string $first_name,
        ?string $last_name,
        ?string $language_code,
        bool $is_bot,
    ) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setLanguage($language_code);
        $this->setIsBot($is_bot);
    }
}
