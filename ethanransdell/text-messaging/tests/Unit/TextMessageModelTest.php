<?php

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use TextMessaging\TextMessageModel;

class TextMessageModelTest extends TestCase
{
    public function testToArray()
    {
        $textMessage = new TextMessageModel();

        $textMessage->id = Str::random();
        $textMessage->from = Str::random();
        $textMessage->to = Str::random();
        $textMessage->body = Str::random();

        $this->assertEquals([
            'id'   => $textMessage->id,
            'to'   => $textMessage->to,
            'from' => $textMessage->from,
            'body' => $textMessage->body,
        ], (array)$textMessage);
    }
}
