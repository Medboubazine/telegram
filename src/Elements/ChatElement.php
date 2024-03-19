<?php

namespace Medboubazine\Telegram\Elements;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class ChatElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        ?string $username,
        ?string $first_name,
        ?string $last_name,
        ?string $type,
    ) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setType($type);
    }
}
