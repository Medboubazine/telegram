<?php

namespace Medboubazine\Telegram\Api;

use Medboubazine\Telegram\Core\Abstracts\ApiClassesAbstract;
use Medboubazine\Telegram\Core\Helpers\Arr;
use Medboubazine\Telegram\Core\Helpers\Carbon;
use Medboubazine\Telegram\Core\Helpers\HttpRequest;
use Medboubazine\Telegram\Core\Helpers\Json;
use Medboubazine\Telegram\Core\Interfaces\ApiClassesInterface;
use Medboubazine\Telegram\Core\Traits\GuzzleHttpTrait;
use Medboubazine\Telegram\Elements\UpdateElement;
use Medboubazine\Telegram\Elements\WebhookElement;

final class Webhook extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;

    /**
     * Get webhooks details
     *
     * @return WebhookElement|null
     */
    public function get(): ?WebhookElement
    {
        $response = $this->__request("POST", "getWebhookInfo");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            return $this->newElement($content_array['result']);
        }

        return false;
    }
    /**
     * Set webhook
     *
     * @param string $url
     * @param string $secret
     * @param integer $max_connections
     * @return boolean
     */
    public function set(string $url, string $secret, int $max_connections): bool
    {
        $query =  http_build_query([
            "url" => $url,
            "secret_token" => $secret,
            "max_connections" => $max_connections,
        ]);
        $response = $this->__request("POST", "setWebhook?{$query}");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            return boolval($content_array['result']);
        }

        return false;
    }
    /**
     * Clear webhook
     *
     * @return boolean
     */
    public function clear(): bool
    {
        $response = $this->__request("POST", "deleteWebhook");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            return boolval($content_array['result']);
        }

        return false;
    }
    /**
     * Capture webhook
     *
     * @param string|null $api_secret_token
     * @return UpdateElement|null
     */
    public function capture(?string $api_secret_token = null): ?UpdateElement
    {
        $data = HttpRequest::data();
        $secret_token = HttpRequest::header("X-Telegram-Bot-Api-Secret-Token");

        if ($api_secret_token === $secret_token) {
            if (isset($data['update_id'])) {
                $data = Arr::map($data, function ($value, $key) {
                    if (is_string($value) and Json::validate($value)) {
                        return json_decode($value, true);
                    }
                    return $value;
                });

                return (new Updates($this->credentials))->newElement($data);
            }
        }
        return null;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return WebhookElement
     */
    public function newElement(array $data): WebhookElement
    {
        return new WebhookElement(
            $data['url'],
            $data['ip_address'] ??  null,
            $data['max_connections'] ?? null,
            $data['pending_update_count'],
            $data['allowed_updates'] ?? null,
            $data['last_error_message'] ?? null,
            (isset($data['last_error_date']) ? Carbon::parse($data['last_error_date']) : null),
            (isset($data['last_synchronization_error_date']) ? Carbon::parse($data['last_synchronization_error_date']) : null),
            $data['has_custom_certificate'],
        );
    }
}
