<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'message',
        'context',
        'location_continent',
        'location_country',
        'location_iso_code',
        'location_city',
        'user_agent',
        'user_id',
        'url',
        'method',
        'input',
        'response',
        'status_code',
        'response_time',
        'response_size',
        'response_headers',
        'request_headers',
    ];
}
