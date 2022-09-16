<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pppconnection extends Model
{
    use HasFactory;

    protected $fillable =[
        'device_id',
        'name',
        "caller-id",
        "service",
        "address",
        "radius",
        "uptime",
    ];
}
