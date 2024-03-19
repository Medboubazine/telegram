<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class PhotoMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        string $unique_id,
        int $size,
        int $width,
        int $height,
    ) {
        $this->setId($id);
        $this->setUniqueId($unique_id);
        $this->setSize($size);
        $this->setWith($width);
        $this->setHeight($height);
    }
}
