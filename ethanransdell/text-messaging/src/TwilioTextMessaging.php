<?php

namespace TextMessaging;

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

    public function send(string $number, string $body): TextMessageModel
    {
        $message = $this->client
            ->messages
            ->create($number, [
                'from' => $this->from,
                'body' => $body,
            ]);

        $textMessage = new TextMessageModel();
        $textMessage->id = $message->sid;
        $textMessage->from = $message->from;
        $textMessage->to = $message->to;
        $textMessage->body = $message->body;

        return $textMessage;
    }
}
