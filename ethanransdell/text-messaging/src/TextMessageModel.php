<?php

namespace TextMessaging;

use Illuminate\Contracts\Support\Arrayable;

class TextMessageModel implements Arrayable
{
    /** @var string */
    public $id;

    /** @var string */
    public $to;

    /** @var string */
    public $from;

    /** @var string */
    public $body;

    public function toArray()
    {
        return [
            'id'   => $this->id,
            'to'   => $this->to,
            'from' => $this->from,
            'body' => $this->body,
        ];
    }
}
