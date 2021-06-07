<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function getRemoteObject(){
        if($this->type =="device"){
            return $device = Device::find($this->remote_id);
        }
    }

    public function device(){
        return $this->belongsTo('App\Models\Device');
    }
}
