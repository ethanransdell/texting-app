<?php

namespace TextMessaging;

use App\TextMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class TextMessageResource extends JsonResource
{
    public function __construct(TextMessage $resource)
    {
        JsonResource::withoutWrapping();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'id'           => $this->resource->id,
            'message_id'   => $this->resource->message_id,
            'to'           => $this->resource->to,
            'from'         => $this->resource->from,
            'body'         => $this->resource->body,
            'user_id'      => $this->resource->user_id,
            'service_name' => $this->resource->service_name,
            'created_at'   => $this->resource->created_at->toISOString(),
            'updated_at'   => $this->resource->updated_at->toISOString(),
        ];
    }
}
