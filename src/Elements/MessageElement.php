<?php

namespace Medboubazine\Telegram\Elements;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Helpers\Carbon;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class MessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        ?UserElement $from,
        ?ChatElement $chat,
        ?Carbon $created_at,
        ?ElementsInterface $message,
    ) {
        $this->setId($id);
        $this->setFrom($from);
        $this->setChat($chat);
        $this->setCreatedAt($created_at);
        $this->setMessage($message);
    }
}
