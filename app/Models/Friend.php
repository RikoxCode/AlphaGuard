<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'accepted',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
