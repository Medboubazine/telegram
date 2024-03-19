<?php

namespace Medboubazine\Telegram\Api;

use Medboubazine\Telegram\Core\Abstracts\ApiClassesAbstract;
use Medboubazine\Telegram\Core\Interfaces\ApiClassesInterface;
use Medboubazine\Telegram\Core\Traits\GuzzleHttpTrait;

final class Messages extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;
    /**
     * Send Text message
     *
     * @param string $id
     * @param string $message
     * @param boolean $protect
     * @param boolean $silent
     * @return void
     */
    public function text(string $id, string $message, bool $protect = true, bool $silent = false): bool
    {
        $query = http_build_query([
            "chat_id" => $id,
            "text" => $message,
            "parse_mode" => "MarkdownV2",
            "disable_notification" => $silent,
            "protect_content" => $protect,
        ]);
        $response = $this->__request("POST", "sendMessage?{$query}");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            return true;
        }
        return false;
    }
    /**
     * Send HTML message
     *
     * @param string $id
     * @param string $message
     * @param boolean $protect
     * @param boolean $silent
     * @return void
     */
    public function html(string $id, string $message, bool $protect = true, bool $silent = false): bool
    {
        $query = http_build_query([
            "chat_id" => $id,
            "text" => $message,
            "parse_mode" => "HTML",
            "disable_notification" => $silent,
            "protect_content" => $protect,
        ]);
        $response = $this->__request("POST", "sendMessage?{$query}");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            return true;
        }
        return false;
    }
}
