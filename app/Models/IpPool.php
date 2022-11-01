<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPool extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id','pool'
    ];

    public function device(){
        return $this->belongsTo('App/Models/Device');
    }
}
