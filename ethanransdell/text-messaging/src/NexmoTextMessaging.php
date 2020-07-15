<?php

namespace TextMessaging;

use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;
use Nexmo\Message\Text;

class NexmoTextMessaging implements TextMessagingInterface
{
    /** @var Client */
    private $client;

    /** @var string */
    private $from;

    public function __construct(string $key, string $secret, string $from)
    {
        $this->client = new Client(new Basic($key, $secret));

        $this->from = $from;
    }

    public static function getServiceName(): string
    {
        return 'nexmo';
    }

    public function send(string $number, string $body): TextMessageModel
    {
        $message = new Text('1' . $number, $this->from, $body);
        $this
            ->client
            ->message()
            ->send($message);

        $textMessage = new TextMessageModel();
        $textMessage->messageId = $message->getMessageId();
        $textMessage->from = substr($message->getFrom(), -10);
        $textMessage->to = substr($message->getTo(), -10);
        $textMessage->body = $body;

        return $textMessage;
    }
}
