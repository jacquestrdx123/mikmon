<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id','address','disabled','dynamic','interface','network'
    ];

    public function device(){
        return $this->belongsTo('App/Models/Device');
    }
}
