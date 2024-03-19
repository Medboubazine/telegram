<?php

namespace Medboubazine\Telegram\Api;

use Medboubazine\Telegram\Core\Abstracts\ApiClassesAbstract;
use Medboubazine\Telegram\Core\Interfaces\ApiClassesInterface;
use Medboubazine\Telegram\Core\Traits\GuzzleHttpTrait;
use Medboubazine\Telegram\Elements\BotElement;

final class GetMe extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;
    /**
     * GetMe
     *
     * @return BotElement|null
     */
    public function call(): ?BotElement
    {
        $response = $this->__request("GET", "GetMe");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            return $this->newElement($content_array['result']);
        }

        return null;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return BotElement
     */
    public function newElement(array $data): BotElement
    {
        return new BotElement(
            $data['id'],
            $data['username'] ?? null,
            $data['first_name'] ?? null,
            $data['is_bot'],
            $data['can_join_groups'] ?? false,
            $data['can_read_all_group_messages'] ?? false,
            $data['supports_inline_queries'] ?? false,
        );
    }
}
