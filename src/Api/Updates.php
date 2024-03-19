<?php

namespace Medboubazine\Telegram\Api;

use Medboubazine\Telegram\Core\Abstracts\ApiClassesAbstract;
use Medboubazine\Telegram\Core\Helpers\Carbon;
use Medboubazine\Telegram\Core\Helpers\Collection;
use Medboubazine\Telegram\Core\Interfaces\ApiClassesInterface;
use Medboubazine\Telegram\Core\Interfaces\ElementsInterface;
use Medboubazine\Telegram\Core\Traits\GuzzleHttpTrait;
use Medboubazine\Telegram\Elements\ChatElement;
use Medboubazine\Telegram\Elements\Message\AudioMessageElement;
use Medboubazine\Telegram\Elements\Message\ContactMessageElement;
use Medboubazine\Telegram\Elements\Message\DocumentMessageElement;
use Medboubazine\Telegram\Elements\Message\LocationMessageElement;
use Medboubazine\Telegram\Elements\Message\PhotoMessageCollectionElement;
use Medboubazine\Telegram\Elements\Message\PhotoMessageElement;
use Medboubazine\Telegram\Elements\Message\PlainTextMessageElement;
use Medboubazine\Telegram\Elements\Message\PollMessageElement;
use Medboubazine\Telegram\Elements\Message\PollOptionsMessageElement;
use Medboubazine\Telegram\Elements\MessageElement;
use Medboubazine\Telegram\Elements\UpdateElement;
use Medboubazine\Telegram\Elements\UserElement;

final class Updates extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;
    /**
     * Get Updates
     *
     * @param string|null $offset
     * @return Collection|null
     */
    public function get(?string $offset = null): ?Collection
    {
        $query = '';
        if ($offset) {
            $query = '?';
            $query .= http_build_query([
                "offset" => $offset,
            ]);
        }

        $response = $this->__request("GET", "getUpdates{$query}");

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);
        if ($status_code == 200 and ($content_array['ok'] ?? false)) {
            $collection = new Collection([]);

            foreach (($content_array['result'] ?? []) as $item) {
                $collection->push($this->newElement($item));
            }

            return $collection;
        }

        return null;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return UpdateElement
     */
    public function newElement(array $data): UpdateElement
    {
        return new UpdateElement(
            $data['update_id'],
            $this->matchEvent($data ?? []),
        );
    }
    /**
     * matchEvent
     *
     * @param array $update_data
     * @return ElementsInterface|null
     */
    protected function matchEvent(array $update_data): ?ElementsInterface
    {
        if (isset($update_data['message'])) {
            $data_message = $update_data['message'];
            $data_from = $data_message['from'];
            $data_chat = $data_message['chat'];

            $from = new UserElement($data_from['id'], $data_from['username'] ?? null, $data_from['first_name'] ?? null, $data_from['last_name'] ?? null, $data_from['language_code'] ?? null, $data_from['is_bot'] ?? false);
            $chat = new ChatElement($data_chat['id'], $data_chat['username']  ?? null, $data_chat['first_name'] ?? null, $data_chat['last_name'] ?? null, $data_chat['type'] ?? null);
            $created = Carbon::parse($data_message['date']);

            return new MessageElement($data_message['message_id'], $from, $chat, $created, $this->matchMessageContent($data_message));
        }

        return null;
    }
    /**
     * Undocumented function
     *
     * @param array $data_message
     * @return ElementsInterface|null
     */
    protected function matchMessageContent(array $data_message): ?ElementsInterface
    {
        if (isset($data_message['text'])) {
            ///
            /// Text message
            ///
            return new PlainTextMessageElement($data_message['text']);
        } else if (isset($data_message['photo'])) {
            ///
            /// Photo
            ///
            $photos = $data_message['photo'];
            $array = [];
            foreach ($photos as $photo) {
                $array[] = new PhotoMessageElement($photo['file_id'], $photo['file_unique_id'], $photo['file_size'], $photo['width'], $photo['height']);
            }
            return new PhotoMessageCollectionElement($array);
        } else if (isset($data_message['document'])) {
            ///
            /// File/Document
            ///
            $document = $data_message['document'];
            $document_thumbnail = $document['thumbnail'] ?? null;

            $thumbnail = null;
            if ($document_thumbnail) {
                $thumbnail = new PhotoMessageElement($document_thumbnail['file_id'], $document_thumbnail['file_unique_id'], $document_thumbnail['file_size'], $document_thumbnail['width'], $document_thumbnail['height']);
            }

            return new DocumentMessageElement($document['file_id'], $document['file_unique_id'], $document['file_name'], $document['mime_type'], $document['file_size'], $thumbnail);
        } else if (isset($data_message['location'])) {
            ///
            /// Location
            ///
            $location = $data_message['location'];

            return new LocationMessageElement($location['latitude'], $location['longitude']);
        } else if (isset($data_message['poll'])) {
            ///
            /// Poll
            ///
            $poll = $data_message['poll'];
            $poll_options = $poll['options'];
            $options = null;
            foreach ($poll_options as $option) {
                $options[] =  new PollOptionsMessageElement($option['text'], $option['voter_count']);
            }
            return new PollMessageElement(
                $poll['id'],
                $poll['question'],
                $poll['type'],
                $options,
                $poll['correct_option_id'],
                $poll['total_voter_count'],
                $poll['explanation'],
                $poll['explanation_entities'],
                $poll['allows_multiple_answers'],
                $poll['is_anonymous'],
                $poll['is_closed']
            );
        } else if (isset($data_message['audio'])) {
            ///
            /// Audio
            ///
            $audio = $data_message['audio'];

            return new AudioMessageElement(
                $audio['file_id'],
                $audio['file_unique_id'],
                $audio['file_name'],
                $audio['mime_type'],
                $audio['file_size'],
                $audio['title'],
                $audio['performer'] ?? null,
                $audio['duration'],
            );
        } else if (isset($data_message['contact'])) {
            ///
            /// Contact
            ///
            $contact = $data_message['contact'];

            return new ContactMessageElement($contact['phone_number'], $contact['first_name'], $contact['vcard']);
        }
        return null;
    }
}
