<?php

namespace Medboubazine\Telegram\Elements\Message;

use Medboubazine\Telegram\Core\Abstracts\ElementsAbstract;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;

class PollMessageElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        string $question,
        string $type,
        ?array $options,
        ?int $correct_option,
        int $total_votes,
        string $explanation,
        array $explanation_entities,
        bool $allows_multiple_answers,
        bool $is_anonymous,
        bool $is_closed,
    ) {
        $this->setId($id);
        $this->setQuestion($question);
        $this->setType($type);
        $this->setOptions($options);
        $this->setCorrectOption($correct_option);
        $this->setTotalVotes($total_votes);
        $this->setExplanation($explanation);
        $this->setExplanationEntities($explanation_entities);
        $this->setMultipleAnswers($allows_multiple_answers);
        $this->setIsAnonymous($is_anonymous);
        $this->setIsClosed($is_closed);
    }
}
