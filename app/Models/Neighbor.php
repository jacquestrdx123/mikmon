<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighbor extends Model
{
    use HasFactory;

    protected $fillable = [
        "device_id",
        "interface",
        "address",
        "address4",
        "identity",
        "platform",
        "version",
        "unpack",
        "age",
        "uptime",
        "software-id",
        "board",
        "ipv6",
        "interface-name",
        "system-caps",
        "system-caps-enabled"
    ];
}
