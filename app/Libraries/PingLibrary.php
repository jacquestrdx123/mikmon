<?php

namespace App\Libraries;


use App\Jobs\PingHistoricalJob;
use App\Jobs\PingJob;
use App\Models\Device;
use App\Models\Event;
use App\Models\Networknode;
use function PHPUnit\Framework\throwException;

class PingLibrary

{

    public static function createIPFiles(){
        $device = Device::all();
        foreach($device as $device){
            $ips[] = $device->ip;
        }
        $counter = sizeof($ips)/5;

        $counter = number_format($counter,0);

        for ($x = 1; $x <= $counter; $x++) {
        try{
            exec("rm -rf /var/www/html/mikmon/storage/pings/ips_to_be_pinged$x.txt");
            }catch (\Exception $e){
            dd($e);

        }
            try{
                exec("touch /var/www/html/mikmon/storage/pings/ips_to_be_pinged$x.txt");
            }catch (\Exception $e){
                dd($e);

            }
            try{
                exec("rm -rf /var/www/html/mikmon/storage/pings/historical_ips_to_be_pinged$x.txt");
            }catch (\Exception $e){
                dd($e);

            }
            try{
                exec("touch /var/www/html/mikmon/storage/pings/historical_ips_to_be_pinged$x.txt");
            }catch (\Exception $e){
                dd($e);
            }
        }
        for ($x = 1; $x <= $counter; $x++) {
            $array[$x] = 1;
        }

        for ($x = 0; $x <= sizeof($ips); $x++) {
            for($y = 1; $y <= sizeof($array);$y++){
                if(isset($ips[$x])){
                    $finals[$y][] = $ips[$x];
                }
                if($y != sizeof($array)){
                    $x++;
                }
            }
        }
        foreach($finals as $key=> $final){
            $file = "/var/www/html/mikmon/storage/pings/ips_to_be_pinged$key.txt";
            $historical_file = "/var/www/html/mikmon/storage/pings/historical_ips_to_be_pinged$key.txt";
            foreach($final as $ip){
                file_put_contents($file, $ip."\n", FILE_APPEND);
                file_put_contents($historical_file, $ip."\n", FILE_APPEND);
            }
        }
        return $array;
    }

    public static function PingAll(){
        $file_count = PingLibrary::createIPFiles();
        foreach($file_count as $filename => $value){
            PingJob::dispatch($filename);
        }

        return true;
    }

    public static function PingWorker($filename){
        \Log::info("Normal Pingworker nr $filename starting with historical_ips_to_be_pinged".$filename);
        $file= "/var/www/html/mikmon/storage/pings/ips_to_be_pinged$filename.txt";
        exec("fping -t 250 -f $file",$results);
        foreach($results as $result){
            $finals[] = preg_split('/ is /',$result);
        }
        foreach($finals as $final){
            $device = Device::where('ip',$final[0])->first();
            PingLibrary::setUpDown($final,$device);
        }
    }

    public static function StoreHistoricalPings()
    {
        $file_count = PingLibrary::createIPFiles();
        foreach($file_count as $filename=> $file){
            PingHistoricalJob::dispatch($filename);
        }

    }

    public static function HistoricalPingWorker($filename){
        \Log::info("Historical Pingworker nr $filename starting with historical_ips_to_be_pinged".$filename);
        $file= "/var/www/html/mikmon/storage/pings/historical_ips_to_be_pinged$filename.txt";
        $results = array();
        $matrix = array();
        $data = array();
        $finalarray = array();
        $iplists = file($file);
        $command = "fping -f $file -c 10 -t 250 2>&1";
        exec($command, $resultsms);
        foreach ($iplists as $iplist){
            $iplist = preg_replace("/\n/", "", $iplist);
            $finalarray[$iplist] = "-";
        }
        foreach($resultsms as $resultsm){
            if(NULL!=strpos($resultsm,'rcv')){
                $resultsm = preg_replace('/    /',' ',$resultsm);
                $resultsm = preg_replace('/   /',' ',$resultsm);
                $resultsm = preg_replace('/  /',' ',$resultsm);
                $results[] = $resultsm;
            }
        }
        foreach ($results as $key => $result) {
            $matrix[]     = preg_split("/ /", $result);
        }

        foreach ($matrix as $iprow){
            $ip = trim($iprow[0]);

            $loss = preg_split('/\//',$iprow[4]);
            $packet_loss = preg_replace('/\%/','',$loss[2]);
            if($packet_loss =="100"){
                $min = -1;
                $max = -1;
                $avg = -1;
                $jitter = -1;
            }else {
                $responses = preg_split('/\//', $iprow[7]);
                $min = $responses[0];
                $max = $responses[2];
                $avg = $responses[1];
                $jitter = $max - $min;
            }
            $data[] = array(
                "ip" => $ip,
                "min" => $min,
                "avg" => $avg,
                "max" => $max,
                "jitter" =>$jitter,
                "packet_loss"=> $packet_loss
            );
        }
        foreach($data as $row){
            \Log::info($row["ip"]." --- ".$row["min"]."/".$row["avg"]."/".$row["max"]."/".$row["jitter"]."/".$row["packet_loss"]);
        }


        foreach ($data as $key=> $row){

            $time = time();
            if(!file_exists("/var/www/html/mikmon/storage/rrd/pings/".trim($row["ip"]).".rrd")){
                \Log::info( "NO RRD FOUND");
                $options = array(
                    '--step','60',
                    "--start", "-1 day",
                    "DS:min:GAUGE:900:U:U",
                    "DS:avg:GAUGE:900:U:U",
                    "DS:max:GAUGE:900:U:U",
                    "DS:jitter:GAUGE:900:U:U",
                    "DS:packet_loss:GAUGE:900:U:U",
                    "RRA:AVERAGE:0.5:5:30000",
                    "RRA:AVERAGE:0.5:60:20000"
                );

                if(!\rrd_create("/var/www/html/mikmon/storage/rrd/pings/".trim($row["ip"]).".rrd",$options)){
                    \Log::info(rrd_error());
                }else{
                        Log::info( "RRD CREATED ".$row['ip']);
                }

            }else{
                $rrdFile ="/var/www/html/mikmon/storage/rrd/pings/".trim($row["ip"]).".rrd";
                //\Log::info("Updating RRD for $ip");
                $updator = new \RRDUpdater($rrdFile);
                $updator->update( array(
                    "min" => round($row["min"],2),
                    "avg" => round($row["avg"],2),
                    "max" => round($row["max"],2),
                    "jitter" => round($row["jitter"],2),
                    "packet_loss" => round($row["packet_loss"],2)
                ), $time);

                \Log::info("Updating RRD for ".$row['ip']);

                PingLibrary::store1DayUptimeRRD($row);
            }
        }
    }

    public static function setUpDown($final,$device){
        \Log::info("Set Updown for $device->ip");
        switch ($device->status) {
            case 4:
                if($final[1]=="unreachable"){
                    $previous_status = $device->status;
                    $device->status = $device->status-1;
                    $event = new Event();
                    $event->type = "device";
                    $event->remote_id = $device->id;
                    $event->current_status = $device->status;
                    $event->previous_status = $previous_status;
                    $event->save();
                }
                break;
            case 3:
                if($final[1]=="unreachable"){
                    $previous_status = $device->status;
                    $device->status = $device->status-1;
                    $event = new Event();
                    $event->type = "device";
                    $event->remote_id = $device->id;
                    $event->current_status = $device->status;
                    $event->previous_status = $previous_status;
                    $event->save();

                }
                if($final[1]=="alive"){
                    $previous_status = $device->status;
                    $device->status = $device->status+1;
                    $event = new Event();
                    $event->type = "device";
                    $event->remote_id = $device->id;
                    $event->current_status = $device->status;
                    $event->previous_status = $previous_status;
                    $event->save();
                }
                break;
            case 2:
                if($final[1]=="unreachable"){
                    $previous_status = $device->status;
                    $device->status = $device->status-1;
                    $event = new Event();
                    $event->type = "device";
                    $event->remote_id = $device->id;
                    $event->current_status = $device->status;
                    $event->previous_status = $previous_status;
                    $event->save();
                }
                if($final[1]=="alive"){
                    $previous_status = $device->status;
                    $device->status = $device->status+1;
                    $event = new Event();
                    $event->type = "device";
                    $event->remote_id = $device->id;
                    $event->current_status = $device->status;
                    $event->previous_status = $previous_status;
                    $event->save();
                }
                break;
            case 1:
                if($final[1]=="alive"){
                    $previous_status = $device->status;
                    $device->status = $device->status+1;
                    $event = new Event();
                    $event->type = "device";
                    $event->remote_id = $device->id;
                    $event->current_status = $device->status;
                    $event->previous_status = $previous_status;
                    $event->save();
                }
                break;
            default:
                break;
        }
        if($device->status == 4){
            $device->current_status = "Online";
        }
        if($device->status == 1){
            $device->current_status = "Offline";
        }
        if( ($device->status > 1) and ($device->status < 4) ){
            $device->current_status = "Unstable";
        }
        $device->save();

    }

    public static function store1DayUptimeRRD($row){
        $time = time();
        if(!file_exists("/var/www/html/mikmon/storage/rrd/pings/uptime/1day/".trim($row["ip"]).".rrd")){
            Log::info( "NO uptime RRD FOUND for  ".$row['ip']);
            $options = array(
                '--step','86400',
                "--start", "-1 day",
                'DS:uptime:GAUGE:43200:U:U',
                'RRA:AVERAGE:0.5:1:365'
            );

            if(!\rrd_create("/var/www/html/mikmon/storage/rrd/pings/uptime/1day/".trim($row["ip"]).".rrd",$options)){
                Log::info(rrd_error());
            }else{
                \Log::info( "RRD CREATED ".$row['ip']);
            }

        }else{
            $rrdFile ="/var/www/html/mikmon/storage/rrd/pings/uptime/1day/".trim($row["ip"]).".rrd";
            \Log::info("Updating 1 day uptime RRD for ".$row['ip']);
            $row['packet_loss'] = preg_replace('/\,/','',$row['packet_loss']);
            $updator = new \RRDUpdater($rrdFile);
            $updator->update( array(
                "uptime" => round((100-$row["packet_loss"]),2)
            ), $time);
        }
    }

}

