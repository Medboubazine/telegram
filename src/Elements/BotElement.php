<?php

namespace Medboubazine\Telegram\Elements;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class BotElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        ?string $username,
        ?string $first_name,
        bool $is_bot,
        bool $can_join_groups,
        bool $can_read_all_group_messages,
        bool $supports_inline_queries
    ) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($first_name);
        $this->setIsBot($is_bot);
        $this->setCanJoinGroups($can_join_groups);
        $this->setCanReadGroupMessages($can_read_all_group_messages);
        $this->setSupportsInlineQueries($supports_inline_queries);
    }
}
