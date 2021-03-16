<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deviceinterface extends Model
{
    use HasFactory;

    protected $fillable = [
        "device_id","ifindex","threshold_tx","threshold_rx","description"
    ];

    public function device(){
        return $this->belongsTo('App\Models\Device');
    }
}
