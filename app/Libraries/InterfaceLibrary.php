<?php
/**
 * Created by PhpStorm.
 * User: jacquestredoux
 * Date: 2017/11/10
 * Time: 8:12 AM
 */
namespace App\Libraries;
use App\Models\Deviceinterface;

class InterfaceLibrary
{
    public static function doInterfaces($device){
        try{
            InterfaceLibrary::StoreInterfaces($device);
        }catch (\Exception $e){
        }
        try{
            InterfaceLibrary::CalculateThroughput($device);
        }catch (\Exception $e){
        }
        echo "Interfaces Done for $device->name \n";
        //$this->CalculateThroughput($device);
    }

    public static function CalculateThroughput($device){
        $newresults = array();
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.6";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.6.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifInpuOct'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifInpuOct'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifInpuOct'][] = $line;
            }
        } catch (\Exception $e) {
        }

        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.10";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.10.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifOutOct'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifOutOct'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifOutOct'][]= $line;
            }
        } catch (\Exception $e) {
        }

        $connections_oid_root_info = "iso.3.6.1.2.1.2.2.1.20";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.2.2.1.20.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifOutErrors'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifOutErrors'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifOutErrors'][] = $line;
            }
        } catch (\Exception $e) {
        }

        $connections_oid_root_info = "iso.3.6.1.2.1.2.2.1.14";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.2.2.1.14.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifInErrors'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifInErrors'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifInErrors'][] = $line;
            }
        } catch (\Exception $e) {
        }
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.7";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.7.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifHCInUcastPkts'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifHCInUcastPkts'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifHCInUcastPkts'][] = $line;
            }
        } catch (\Exception $e) {
        }
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.11";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.11.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifHCOutUcastPkts'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifHCOutUcastPkts'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifHCOutUcastPkts'][] = $line;
            }
        } catch (\Exception $e) {
        }
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.8";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.8.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifHCInMulticastPkts'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifHCInMulticastPkts'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifHCInMulticastPkts'][] = $line;
            }
        } catch (\Exception $e) {
        }
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.12";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.12.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifHCOutMulticastPkts'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifHCOutMulticastPkts'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifHCOutMulticastPkts'][] = $line;
            }
        } catch (\Exception $e) {
        }
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.9";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.9.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifHCInBroadcastPkts'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifHCInBroadcastPkts'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifHCInBroadcastPkts'][] = $line;
            }
        } catch (\Exception $e) {
        }
        $connections_oid_root_info = "iso.3.6.1.2.1.31.1.1.1.13";
        $raw_connections_oid_root_info = ".1.3.6.1.2.1.31.1.1.1.13.";
        try {
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
            $results['ifHCOutBroadcastPkts'] = snmp2_real_walk($device->ip, $device->snmp_community, $connections_oid_root_info);
            foreach ($results['ifHCOutBroadcastPkts'] as $key => $line) {
                $newkey = preg_split("/$raw_connections_oid_root_info/", $key);
                $newresults[$newkey['1']]['ifHCOutBroadcastPkts'][] = $line;
            }
        } catch (\Exception $e) {
        }


        foreach($newresults as $key=> $newresult){
            if(array_key_exists('ifHCInUcastPkts',$newresult)){
                $ifHCInUcastPkts = preg_split('/Counter64:/',$newresult['ifHCInUcastPkts'][0]);
            }else{
                $ifHCInUcastPkts[0] = 0;
                $ifHCInUcastPkts[1] = 0;
            }
            if(array_key_exists('ifHCOutUcastPkts',$newresult)){
                $ifHCOutUcastPkts = preg_split('/Counter64:/',$newresult['ifHCOutUcastPkts'][0]);
            }else{
                $ifHCOutUcastPkts[0] = 0;
                $ifHCOutUcastPkts[1] = 0;
            }
            if(array_key_exists('ifHCInMulticastPkts',$newresult)){
                $ifHCInMulticastPkts =  preg_split('/Counter64:/',$newresult['ifHCInMulticastPkts'][0]);
            }else{
                $ifHCInMulticastPkts[0] = 0;
                $ifHCInMulticastPkts[1] = 0;
            }
            if(array_key_exists('ifHCOutMulticastPkts',$newresult)){
                $ifHCOutMulticastPkts = preg_split('/Counter64:/',$newresult['ifHCOutMulticastPkts'][0]);
            }else{
                $ifHCOutMulticastPkts[0] = 0;
                $ifHCOutMulticastPkts[1] = 0;
            }
            if(array_key_exists('ifHCInBroadcastPkts',$newresult)){
                $ifHCInBroadcastPkts = preg_split('/Counter64:/',$newresult['ifHCInBroadcastPkts'][0]);
            }else{
                $ifHCInBroadcastPkts[0] = 0;
                $ifHCInBroadcastPkts[1] = 0;
            }
            if(array_key_exists('ifHCOutBroadcastPkts',$newresult)){
                $ifHCOutBroadcastPkts = preg_split('/Counter64:/',$newresult['ifHCOutBroadcastPkts'][0]);
            }else{
                $ifHCOutBroadcastPkts[0] = 0;
                $ifHCOutBroadcastPkts[1] = 0;
            }
            if(array_key_exists('ifInpuOct',$newresult)){
                $inoctets = preg_split('/Counter64:/',$newresult['ifInpuOct'][0]);
            }else{
                $inoctets[0] = 0;
                $inoctets[1] = 0;
            }
            if(array_key_exists('ifOutOct',$newresult)){
                $outoctets = preg_split('/Counter64:/',$newresult['ifOutOct'][0]);
            }else{
                $outoctets[0] = 0;
                $outoctets[1] = 0;
            }
            if(array_key_exists('ifOutErrors',$newresult)){
                $outerrors = preg_split('/Counter32:/',$newresult['ifOutErrors'][0]);
            }else{
                $outerrors[0] = 0;
                $outerrors[1] = 0;
            }
            if(array_key_exists('ifInErrors',$newresult)){
                $inerrors = preg_split('/Counter32:/',$newresult['ifInErrors'][0]);
            }else{
                $inerrors[0] = 0;
                $inerrors[1] = 0;
            }

            $interfaceresults[$key]['rxvalue'] = $inoctets[1];
            $interfaceresults[$key]['txvalue'] = $outoctets[1];
            $interfaceresults[$key]['ifInErrors'] = $inerrors[1];
            $interfaceresults[$key]['ifOutErrors'] = $outerrors[1];
            $interfaceresults[$key]['ifHCInUcastPkts'] = $ifHCInUcastPkts[1];
            $interfaceresults[$key]['ifHCOutUcastPkts'] = $ifHCOutUcastPkts[1];
            $interfaceresults[$key]['ifHCInMulticastPkts'] = $ifHCInMulticastPkts[1];
            $interfaceresults[$key]['ifHCOutMulticastPkts'] = $ifHCOutMulticastPkts[1];
            $interfaceresults[$key]['ifHCInBroadcastPkts'] = $ifHCInBroadcastPkts[1];
            $interfaceresults[$key]['ifHCOutBroadcastPkts'] = $ifHCOutBroadcastPkts[1];
        }

        try{
            foreach($interfaceresults as $key=> $item){
                $data = array(
                    "host" => $device->id,
                    "txvalue" => $item['txvalue'],
                    "rxvalue" => $item['rxvalue'],
                    "ifInErrors" => $item['ifInErrors'],
                    "ifOutErrors" => $item['ifOutErrors'],
                    "ifHCInUcastPkts" => $item['ifHCInUcastPkts'],
                    "ifHCOutUcastPkts" => $item['ifHCOutUcastPkts'],
                    "ifHCInMulticastPkts" => $item['ifHCInMulticastPkts'],
                    "ifHCOutMulticastPkts" => $item['ifHCOutMulticastPkts'],
                    "ifHCInBroadcastPkts" => $item['ifHCInBroadcastPkts'],
                    "ifHOutBroadcastPkts" => $item['ifHCOutBroadcastPkts'],
                    "iname" => $key
                );
                $value = 1;

                $files = [
                    '/nfs/home/websites/mikmon/storage/rrd/'.$device->id,
                    "/nfs/home/websites/mikmon/storage/rrd/".$device->id."/interfaces"
                ];
                foreach($files as $file){
                    if(!file_exists($file)){
                        exec("mkdir ".$file);
                    }
                }
                $rrdFile = $files['1']."/".$key.".rrd";
//                InfluxLibrary::writeToDB("dte", "interfaces", $data, $value);
                if(!file_exists($rrdFile)){
                    echo "NO RRD FOUND \n";
                    $options = array(
                        '--step', '300',
                        "--start", "-1 day",
                        "DS:rxvalue:GAUGE:900:U:U",
                        "DS:txvalue:GAUGE:900:U:U",
                        "DS:ifInErrors:GAUGE:900:U:U",
                        "DS:ifOutErrors:GAUGE:900:U:U",
                        "DS:ifHCInUPkts:GAUGE:900:U:U",
                        "DS:ifHCOutUPkts:GAUGE:900:U:U",
                        "DS:ifHCInMultiPkts:GAUGE:900:U:U",
                        "DS:ifHCOutMultiPkts:GAUGE:900:U:U",
                        "DS:ifHCInBroadPkts:GAUGE:900:U:U",
                        "DS:ifHOutBroadPkts:GAUGE:900:U:U",
                        "DS:Availabilty:GAUGE:900:U:U",
                        "RRA:LAST:0.5:1:120000"
                    );
                    echo "CREATING RRD ".trim($device->id)."/".trim($key).".rrd \n";
                    if(!\rrd_create($rrdFile,$options)){
                        echo rrd_error();
                    }
                }else{
                    $dinterface = Deviceinterface::where('default_name', '=', $key)->where('device_id',$device->id)->first();
                    if($dinterface->running =="true"){
                        $running = 100;
                    }else{
                        $running = 0;
                    }
                    $time = time();
//                    \Log::info("Updating $dinterface->id $rrdFile with tx value-".trim($data['txvalue'])."-\n");
                    $updator = new \RRDUpdater($rrdFile);
                    $updator->update(array(
                        "rxvalue" => trim($data["rxvalue"]),
                        "txvalue" => trim($data["txvalue"]),
                        "ifInErrors" => trim($data["ifInErrors"]),
                        "ifOutErrors" => trim($data["ifOutErrors"]),
                        "ifHCInUPkts" => trim($data['ifHCInUcastPkts']),
                        "ifHCOutUPkts" => trim($data['ifHCOutUcastPkts']),
                        "ifHCInMultiPkts" => trim($data['ifHCInMulticastPkts']),
                        "ifHCOutMultiPkts" => trim($data['ifHCOutMulticastPkts']),
                        "ifHCInBroadPkts" => trim($data['ifHCInBroadcastPkts']),
                        "ifHOutBroadPkts" => trim($data['ifHOutBroadcastPkts']),
                        "Availabilty" => trim($running)
                    ), $time);
                }
            }
        }catch (\Exception $e){
        }

    }

    public static function StoreInterfaces($device){
        $interfaceresults = array();
        echo "Starting new Interfaces";
        try {
            InterfaceLibrary::storeInterfacesINDB($device);
        }catch (\Exception $e){
            dd($e);
        }
    }

    public static function storeInterfacesINDB($device){
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        $interfaceresults = array();
        $finals = array();
        $count = 1;
        while($count != 0) {
            try {
                $connections_oid_root = "1.3.6.1.2.1.2.2.1.$count";
                snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
                $result = snmp2_walk($device->ip, $device->snmp_community, $connections_oid_root);
                foreach ($result as $key => $line) {
                    $finals[$count][] = $line;
                }
                $count++;
            } catch (\Exception $e) {
                $count = 0;
            }
        }

        foreach ($finals as $rows){
            foreach($rows as $key=> $row){
                $interfaceresults[$key][] = $row;
            }
        }
        foreach($interfaceresults as $index => $interfaceresult) {
            $count = 0;
            $typeid = preg_replace('/INTEGER: /', '', $interfaceresult['2']);
            $type = InterfaceLibrary::getType($typeid);
            $device_id = $device->id;
            if ( (strpos($interfaceresult['1'], '<pppoe-')) ) {

            } else {

                if ( (Deviceinterface::where('default_name', '=', trim(preg_replace('/INTEGER: /', '', $interfaceresult['0'])))->where('device_id', $device->id)->exists() ) AND ($type!="other") ) {
                    $dinterface = Deviceinterface::where('default_name', '=', trim(preg_replace('/INTEGER: /', '', $interfaceresult['0'])))->where('device_id', $device->id)->first();
                    if (strpos($interfaceresult['1'], 'Hex-STRING:') !== false) {
                        $name = preg_replace('/Hex-STRING: /', '', $interfaceresult['1']);
                        $name = InterfaceLibrary::hexToStr($name);
                    } else {
                        $name = preg_replace('/"/', '', $interfaceresult['1']);
                        $name = preg_replace('/STRING: / ', '', $name);
                        $name = preg_replace('/"/', '', $name);
                    }
                    $dinterface->name = $name;
                    $dinterface->default_name = trim(preg_replace('/INTEGER: /', '', $interfaceresult['0']));
                    if (strpos($interfaceresult['5'], 'Hex-STRING:') !== false) {
                        $mac = preg_replace('/Hex-STRING: /', '', $interfaceresult['5']);
                        $mac = InterfaceLibrary::hexToStr($mac);
                    } else {
                        $mac = preg_replace('/STRING: /', '', $interfaceresult['5']);
                        $mac = preg_replace('/ /', ':', $mac);
                        $mac = substr($mac, 0, -1);
                    }

                    $dinterface->mac_address = $mac;
                    $typeid = preg_replace('/INTEGER: /', '', $interfaceresult['2']);
                    $dinterface->type = InterfaceLibrary::getType($typeid);
                    $ifRunning = preg_replace('/INTEGER: /', '', $interfaceresult['6']);
                    $ifRunning = preg_replace('/up\(/', '',$ifRunning);
                    $ifRunning = preg_replace('/\)/', '', $ifRunning);
                    if ($ifRunning == "1") {
                        $ifRunning = "true";
                    } else {
                        $ifRunning = "false";
                    }
                    $dinterface->previous_running_state = $dinterface->running;
                    $dinterface->running = $ifRunning;
                    $dinterface->previous_link_speed = $dinterface->link_speed;

                    $dinterface->link_speed = preg_replace('/Gauge32: /', '', $interfaceresult['4']);
                    $dinterface->last_link_down_time = "n/a";
                    $dinterface->last_link_up_time = "n/a";
                    $dinterface->mtu = preg_replace('/INTEGER: /', '', $interfaceresult['3']);
                    $dinterface->actual_mtu = preg_replace('/INTEGER: /', '', $interfaceresult['3']);
                    $ifAdmin = preg_replace('/INTEGER: /', '', $interfaceresult['7']);
                    if ($ifAdmin == "2") {
                        $ifAdmin = "true";
                    } else {
                        $ifAdmin = "false";
                    }
                    $dinterface->disabled = $ifAdmin;
                    $dinterface->device_id = $device_id;
                    $dinterface->save();
                } elseif(Deviceinterface::where('name', '=', trim(preg_replace('/STRING: /', '', $interfaceresult['1'])))->where('device_id', $device->id)->exists()){
                    $dinterface = Deviceinterface::where('name', '=', trim(preg_replace('/STRING: /', '', $interfaceresult['1'])))->where('device_id', $device->id)->first();
                    if (strpos($interfaceresult['1'], 'Hex-STRING:') !== false) {
                        $name = preg_replace('/Hex-STRING: /', '', $interfaceresult['1']);
                        $name = InterfaceLibrary::hexToStr($name);
                    } else {
                        $name = preg_replace('/"/', '', $interfaceresult['1']);
                        $name = preg_replace('/STRING: / ', '', $name);
                        $name = preg_replace('/"/', '', $name);
                    }
                    $dinterface->name = $name;
                    $dinterface->default_name = trim(preg_replace('/INTEGER: /', '', $interfaceresult['0']));
                    if (strpos($interfaceresult['5'], 'Hex-STRING:') !== false) {
                        $mac = preg_replace('/Hex-STRING: /', '', $interfaceresult['5']);
                        $mac = InterfaceLibrary::hexToStr($mac);
                    } else {
                        $mac = preg_replace('/STRING: /', '', $interfaceresult['5']);
                        $mac = preg_replace('/ /', ':', $mac);
                        $mac = substr($mac, 0, -1);
                    }

                    $dinterface->mac_address = $mac;
                    $typeid = preg_replace('/INTEGER: /', '', $interfaceresult['2']);
                    $dinterface->type = InterfaceLibrary::getType($typeid);
                    $ifRunning = preg_replace('/INTEGER: /', '', $interfaceresult['6']);
                    $ifRunning = preg_replace('/up\(/', '',$ifRunning);
                    $ifRunning = preg_replace('/\)/', '', $ifRunning);
                    if ($ifRunning == "1") {
                        $ifRunning = "true";
                    } else {
                        $ifRunning = "false";
                    }
                    $dinterface->previous_running_state = $dinterface->running;
                    $dinterface->running = $ifRunning;
                    $dinterface->previous_link_speed = $dinterface->link_speed;

                    $dinterface->link_speed = preg_replace('/Gauge32: /', '', $interfaceresult['4']);
                    $dinterface->last_link_down_time = "n/a";
                    $dinterface->last_link_up_time = "n/a";
                    $dinterface->mtu = preg_replace('/INTEGER: /', '', $interfaceresult['3']);
                    $dinterface->actual_mtu = preg_replace('/INTEGER: /', '', $interfaceresult['3']);
                    $ifAdmin = preg_replace('/INTEGER: /', '', $interfaceresult['7']);
                    if ($ifAdmin == "2") {
                        $ifAdmin = "true";
                    } else {
                        $ifAdmin = "false";
                    }
                    $dinterface->disabled = $ifAdmin;
                    $dinterface->device_id = $device_id;
                    $dinterface->save();
                }else{
                    $dinterface = new Deviceinterface();
                    $name = preg_replace('/"/', '', $interfaceresult['1']);
                    $name = preg_replace('/STRING:/ ', '', $name);
                    $dinterface->name = preg_replace('/"/', '', $name);
                    $dinterface->default_name = trim(preg_replace('/INTEGER: /', '', $interfaceresult['0']));
                    $mac = preg_replace('/STRING: /', '', $interfaceresult['5']);
                    $mac = preg_replace('/ /', ':', $mac);
                    $mac = substr($mac, 0, -1);
                    $dinterface->mac_address = $mac;
                    $typeid = preg_replace('/INTEGER: /', '', $interfaceresult['2']);
                    $dinterface->type = InterfaceLibrary::getType($typeid);
                    $ifRunning = preg_replace('/INTEGER: /', '', $interfaceresult['6']);
                    if ($ifRunning == "1") {
                        $ifRunning = "true";
                    } else {
                        $ifRunning = "false";
                    }
                    $dinterface->previous_running_state = $ifRunning;
                    $dinterface->running = $ifRunning;
                    $dinterface->previous_link_speed = preg_replace('/Gauge32: /', '', $interfaceresult['4']);
                    $dinterface->link_speed = preg_replace('/Gauge32: /', '', $interfaceresult['4']);
                    $dinterface->last_link_down_time = "n/a";
                    $dinterface->last_link_up_time = "n/a";
                    $dinterface->mtu = preg_replace('/INTEGER: /', '', $interfaceresult['3']);
                    $dinterface->actual_mtu = preg_replace('/INTEGER: /', '', $interfaceresult['3']);
                    $ifAdmin = preg_replace('/INTEGER: /', '', $interfaceresult['7']);
                    if ($ifAdmin == "2") {
                        $ifAdmin = "true";
                    } else {
                        $ifAdmin = "false";
                    }
                    $dinterface->disabled = $ifAdmin;
                    $dinterface->device_id = $device_id;
                    $dinterface->save();
                    $value = 1;
//                InfluxLibrary::writeToDB("dte", "interfaces_status", $data, $value);
                }
            }
        }
        echo "\n Interfaces Done \n";
    }

    public static function getType($id){
        if($id==53){
            return "Vlan";
        }
        if($id==6){
            return "Ethernet";
        }
        if($id==0){
            return  "Other";
        }
        if($id==157){
            return "Wireless";
        }
        return "Other";
    }

    public static function hexToStr($hex){
        $hex = preg_replace('/ /',':',$hex);
        $hex = substr($hex, 0, -1);
        return $hex;
    }
}
