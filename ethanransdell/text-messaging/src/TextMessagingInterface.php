<?php

namespace TextMessaging;

interface TextMessagingInterface
{
    public function getServiceName(): string;

    public function send(string $number, string $message): TextMessageModel;
}
