<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class LocationMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        float $latitude,
        float $longitude,
    ) {
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }
}
