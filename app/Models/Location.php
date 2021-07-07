<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable =['description','longitude','latitude'];

    public function devices(){
        return $this->hasMany('App\Models\Device');
    }

    public static function updateCounters(){
        $locations = Location::withCount(['devices'])->get();
        foreach($locations as $location){
            $fault = 0;
            foreach($location->devices as $networknode){
                if($networknode->status ==1){
                    $fault += 1;
                }
            }
            if($fault > 0){
                $location->nodes_offline = $fault;
                $location->nodes_count = $location->devices_count;
                if($location->nodes_count==$fault){
                    $location->status = 1;
                }else{
                    $location->status = 2;
                }
                $location->save();
            }else{
                $location->nodes_offline = $fault;
                $location->nodes_count = $location->devices_count;
                $location->status = 3;
                $location->save();
            }
        }
    }

}
