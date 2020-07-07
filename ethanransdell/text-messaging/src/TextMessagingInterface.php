<?php

namespace TextMessaging;

interface TextMessagingInterface
{
    public function send(string $number, string $message): TextMessageModel;
}
