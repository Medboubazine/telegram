<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class PlainTextMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(string $content)
    {
        $this->setContent($content);
    }
    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getContent();
    }
}
