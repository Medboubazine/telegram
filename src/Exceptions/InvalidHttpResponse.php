<?php

namespace Medboubazine\Telegram\Exceptions;

use Exception;
use Medboubazine\Telegram\Core\Helpers\Json;

final class InvalidHttpResponse extends Exception
{
    /**
     * Message
     *
     * @param [type] $response
     * @param [type] $code
     * @return void
     */
    public static function message($response, $code)
    {
        $status = $response->getStatusCode();
        $reasonPhrase = $response->getReasonPhrase();
        $content = $response->getBody()->getContents();

        $content_message = "";
        if (Json::validate($content)) {
            $content_message = "(Content: {$content})";
        }
        throw new self("Invalid Http response (Status: {$status}:{$reasonPhrase}) {$content_message}.", $code);

        return;
    }
}
