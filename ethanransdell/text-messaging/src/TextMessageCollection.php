<?php

namespace TextMessaging;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TextMessageCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        JsonResource::withoutWrapping();

        parent::__construct($resource);
    }

    public $collects = 'TextMessaging\\TextMessageResource';
}
