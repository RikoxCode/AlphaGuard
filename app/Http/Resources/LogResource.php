<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (integer)$this->id,
            'user_agent' => $this->user_agent,
            'user_id' => $this->user_id,
            'ip' => $this->ip,
            'url' => $this->url,
            'method' => $this->method,
            'input' => $this->input,
            'response' => $this->response,
            'status_code' => (integer)$this->status_code,
            'response_time' => $this->response_time,
            'response_size' => $this->response_size,
            'response_headers' => $this->response_headers,
            'request_headers' => $this->request_headers,
            'level' => $this->level,
            'message' => $this->message,
            'context' => $this->context,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
