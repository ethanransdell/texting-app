<?php

namespace TextMessaging;

use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class TwilioTextMessaging implements TextMessagingInterface
{
    /** @var Client */
    private $client;

    /** @var string */
    private $from;

    public function __construct(string $sid, string $token, string $from)
    {
        $this->client = new Client($sid, $token);

        $this->from = $from;
    }

    public static function getServiceName(): string
    {
        return 'twilio';
    }

    public function send(string $number, string $body): TextMessageModel
    {
        $message = $this->client
            ->messages
            ->create($number, [
                'from' => $this->from,
                'body' => $body,
            ]);

        return $this->buildTextMessage($message);
    }

    public function get(string $mesasageId): TextMessageModel
    {
        $message = $this
            ->client
            ->messages($mesasageId)
            ->fetch();

        return $this->buildTextMessage($message);
    }

    private function buildTextMessage(MessageInstance $message): TextMessageModel
    {
        $textMessage = new TextMessageModel();
        $textMessage->messageId = $message->sid;
        $textMessage->from = substr($message->from, -10);
        $textMessage->to = substr($message->to, -10);
        $textMessage->body = $message->body;
        $textMessage->status = $message->status;

        return $textMessage;
    }
}
