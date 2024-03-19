<?php

namespace Medboubazine\Telegram\Elements;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Helpers\Carbon;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class WebhookElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $url,
        ?string $ip_address,
        ?string $max_connections,
        string $pending_update_count,
        ?array $allowed_updates,
        ?string $last_error_message,
        ?Carbon $last_error_date,
        ?Carbon $last_synchronization_error_date,
        bool $has_custom_certificate,
    ) {
        $this->setUrl($url);
        $this->setIp($ip_address);
        $this->setMaxConnections($max_connections);
        $this->setPendingUpdates($pending_update_count);
        $this->setAllowedUpdates($allowed_updates);
        $this->setLastErrorMessage($last_error_message);
        $this->setLastErrorDate($last_error_date);
        $this->setLastSynchronizationErrorDate($last_synchronization_error_date);
        $this->setHasCertificate($has_custom_certificate);
    }
}
