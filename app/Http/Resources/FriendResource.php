<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'email' => $this->email,
            'nickname' => $this->nickname,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'permissions_level' => $this->permissions_level,
            'is_sys_admin' => $this->is_admin,
            'is_blocked' => $this->is_blocked,
            'blocked_reason' => $this->blocked_reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
