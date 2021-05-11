<?php

namespace App\Models;

use App\Jobs\PollWorker;
use App\Libraries\MikrotikLibrary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'devicetype',
        'location_id',
        "description",
        'username',
        'password',
        'snmp_community',
        "fan-mode",
        "use-fan",
        "active-fan",
        "cpu-overtemp-check",
        "cpu-overtemp-threshold",
        "cpu-overtemp-startup-delay",
        "voltage",
        "current",
        "temperature",
        "cpu-temperature",
        "power-consumption",
        "fan1-speed",
        "fan2-speed",
        "model",
        "used_memory",
        "total_memory",
        "uptime",
        "serial-number",
        "firmware-type",
        "factory-firmware",
        "current-firmware",
        "upgrade-firmware"
    ];

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }
    public function deviceinterfaces(){
        return $this->hasMany('App\Models\Deviceinterface');
    }
    public function ips(){
        return $this->hasMany('App\Models\Ip');
    }
    public function gateways(){
        return $this->hasMany('App\Models\Gateway');
    }

    public function getDownTime(){
        return $this->secondsToTime(strtotime($this->last_offline)-strtotime('now'));
    }

    public function  secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}

    public static function PollDeviceById($id){
        $device = Device::find($id);
        if($device->devicetype == "mikrotik"){
            MikrotikLibrary::PollDevice($device);
        }
    }

    public static function PollDevice($device){
        if($device->devicetype=="mikrotik"){
            MikrotikLibrary::PollDevice($device);
        }
    }

    public static function PollDevices(){
        $formatted_date_now = date("Y-m-d H:i:s", strtotime('+2 hours'));
        $take =  round(Device::count()/3,0);
        $devices = Device::orderBy('update_started','ASC')->take($take)->get();
        foreach ($devices as $device) {
            $device->update_started = $formatted_date_now;
            $device->save();
            if($device->status ==4){
                \Log::info("Device $device->ip is has started polling");
                PollWorker::dispatch($device);
            }else{
                \Log::info("Device $device->ip is offline. Not Polling");
            }
        }
    }

    public static function findHourlyLatencySpikes(){
        $devices = Device::get();
        $array = array();
        foreach($devices as $device) {
            if ($device->status == "4") {
                dd($device);
                $rrdFile = config('rrd.storage_path')."/pings/". trim($device->ip) . ".rrd";
                $result = \rrd_fetch($rrdFile, array(config('rrd.ds'), "--resolution", config("rrd.step"), "--start", (time() - 86400), "--end", (time() - 350)));
                if (isset($result['data'])) {

                    $stats = array();
                    foreach ($result['data']['avg'] as $key => $datum) {
                        $values = array(
                            "time" => $key,
                            "value" => $datum
                        );
                        $stats[] = $values;
                    }
                    if (isset($stats)) {
                        foreach ($stats as $stat) {

                            if ($stat['value'] > 100) {
                                $array[$device->location->name][$device->name][] = array(
                                    "url" => "<a href='/device/" . $device->id . "'>OPEN DEVICE</a>",
                                    "type" => "High Latency",
                                    "year" => date("Y-m-d H:i:s", $stat['time']),
                                    "ip" => $device->ip,
                                    "value" => $stat['value'] . " ms"
                                );
                            }
                        }
                    }
                    $stats = array();
                    foreach ($result['data']['packet_loss'] as $key => $datum) {
                        $values = array(
                            "time" => $key,
                            "value" => $datum
                        );
                        $stats[] = $values;
                    }
                    if (isset($stats)) {
                        foreach ($stats as $stat) {

                            if (($stat['value'] > 10) and($stat['value'] < 100)) {
                                $array[$device->location->name][$device->name][] = array(
                                    "url" => "<a href='/device/" . $device->id . "'>OPEN DEVICE</a>",
                                    "type" => "High packet loss",
                                    "year" => date("Y-m-d H:i:s", $stat['time']),
                                    "ip" => $device->ip,
                                    "value" => $stat['value'] . " %"
                                );
                            }
                        }
                    }
                    foreach ($result['data']['jitter'] as $key => $datum) {
                        $values = array(
                            "time" => $key,
                            "value" => $datum
                        );
                        $stats[] = $values;
                    }
                    if (isset($stats)) {
                        foreach ($stats as $stat) {

                            if ($stat['value'] > "100") {
                                $array[$device->location->name][$device->name][] = array(
                                    "url" => "<a href='/device/" . $device->id . "'>OPEN DEVICE</a>",
                                    "type" => "High jitter",
                                    "year" => date("Y-m-d H:i:s", $stat['time']),
                                    "ip" => $device->ip,
                                    "value" => $stat['value'] . " ms"
                                );
                            }
                        }
                    }
                }
            }
        }
        return $array;
    }

}
