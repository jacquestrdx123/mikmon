<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dhcplease extends Model
{
    use HasFactory;

    protected $fillable = [
        "address",
        "mac_address",
        "client_id",
        "status",
        "expires_after",
        "last_seen",
        "active_address",
        "active_mac_address",
        "active_client_id",
        "host_name",
        "dynamic",
        "device_id"
    ];
}
