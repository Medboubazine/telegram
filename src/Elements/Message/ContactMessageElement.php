<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class ContactMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $number,
        string $first_name,
        string $vcard,
    ) {
        $this->setNumber($number);
        $this->setFirstName($first_name);
        $this->setVcard($vcard);
    }
}
