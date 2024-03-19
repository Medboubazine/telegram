<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class PhotoMessageCollectionElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(array $items)
    {
        $this->setItems($items);
    }
}
