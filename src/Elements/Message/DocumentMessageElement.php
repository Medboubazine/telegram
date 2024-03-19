<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class DocumentMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        string $unique_id,
        string $name,
        string $mime_type,
        int $size,
        ?PhotoMessageElement $thumbnail
    ) {
        $this->setId($id);
        $this->setUniqueId($unique_id);
        $this->setName($name);
        $this->setMimeType($mime_type);
        $this->setSize($size);
        $this->setThumbnail($thumbnail);
    }
}
