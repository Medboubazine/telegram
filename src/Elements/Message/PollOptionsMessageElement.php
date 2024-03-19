<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class PollOptionsMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $text,
        string $votes,
    ) {
        $this->setText($text);
        $this->setVotes($votes);
    }
}
