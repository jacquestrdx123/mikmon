<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable =[
        'ip',
        'device_id',
        'status',
        'active',
        'disabled',
        'internet'
    ];

    public function device(){
        return $this->belongsTo(Device::class);
    }

}
