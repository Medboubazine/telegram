<?php

namespace Medboubazine\Telegram\Elements;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class UpdateElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        ?ElementsInterface $event,
    ) {
        $this->setId($id);
        $this->setEvent($event);
    }
}
