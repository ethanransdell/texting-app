<?php

namespace TextMessaging;

interface TextMessagingInterface
{
    public static function getServiceName(): string;

    public function send(string $number, string $message): TextMessageModel;

    public function get(string $mesasageId): TextMessageModel;
}
