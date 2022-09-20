<?php

namespace App\Libraries;

use App\Libraries\InterfaceLibrary;
use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Dhcplease;
use App\Models\Gateway;
use App\Models\Ip;
use App\Models\Neighbor;
use App\Models\Pppconnection;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Log;

class MikrotikLibrary
{

    public static function PollDevice($device){
            \Log::info('Polling '.$device->ip." API");
            MikrotikLibrary::pollViaAPI($device);
            \Log::info('Polling '.$device->ip." SNMP");
            MikrotikLibrary::pollViaSNMP($device);
            \Log::info('Done Polling '.$device->ip."");
            \Log::info('Syncing Interfaces for '.$device->ip."");
            $interfacelibrary = new InterfaceLibrary();
            $interfacelibrary->syncInterfaces($device);
            \Log::info('Done Syncing Interfaces for '.$device->ip."");
    }
    public static function PollDeviceDebug($device){
        echo('Polling '.$device->ip." API");
        MikrotikLibrary::pollViaAPI($device,true);
        echo('Polling '.$device->ip." SNMP");
        MikrotikLibrary::pollViaSNMP($device);
        echo('Done Polling '.$device->ip."");
        echo('Syncing Interfaces for '.$device->ip."");
        $interfacelibrary = new InterfaceLibrary();
        $interfacelibrary->syncInterfaces($device);
        echo('Done Syncing Interfaces for '.$device->ip."");
    }

    public static function pollViaAPI($device,$debug = false){
        $api = new RouterosAPI();
        if($debug ==true){
            $api->debug = true;
        }
        if ($api->connect($device->ip, $device->username, $device->password)) {
            $results["system_identity"] = MikrotikLibrary::getSystemIdentity($api);
            $results["system_health"] =  MikrotikLibrary::getSystemHealth($api);
            $results["system_info"] = MikrotikLibrary::getSystemInfo($api);
            $results["dhcp_leases"] = MikrotikLibrary::getDHCPLeases($api);
            $results["ppp_active"] = MikrotikLibrary::getActivePPP($api);
            $results["ip_neighbours"] = MikrotikLibrary::getIPNeighbors($api);
            $results["default_gateways"] = MikrotikLibrary::getDefaultGateways($api);
            $results["ip_adresses"] = MikrotikLibrary::getIPAddresses($api);
            $api->disconnect();
            $results['snmp_sys_info'] = MikrotikLibrary::getSNMPSystemValues($device);
            MikrotikLibrary::updateSystemInfo($results,$device);
            MikrotikLibrary::updateOrCreateDHCP($results['dhcp_leases'],$device);
            MikrotikLibrary::updateOrCreateIpNeighbors($results['ip_neighbours'],$device);
            MikrotikLibrary::updateOrCreateDefaultGateways($results['default_gateways'],$device);
            MikrotikLibrary::updateOrCreateIPAddresses($results['ip_adresses'],$device);
            MikrotikLibrary::updateOrCreateActivePPP($results['ppp_active'],$device);

        }
    }

    public static function fixConfig($device){
        $api = new RouterosAPI();
        $api->debug = true;
        if ($api->connect($device->ip, $device->username, $device->password)) {
                $api->write('/snmp/community/add',false);
                $api->write('=name=dude',true);
                $api->read();
                $api->write('/snmp/community/add',false);
                $api->write('=name=ittx',true);
                $api->read();

                $api->write('/snmp/set',false);
                $api->write('=enabled=yes',false);
                $api->write('=trap-community=dude',true);
                $results = $api->read();
            try{
                $API->write('/interface/pppoe-server/server/print',true);
                $READ = $API->read();
                if (array_key_exists('0',$READ)){
                    foreach($READ as $row){
                        $API->write('/interface/pppoe-server/server/set',false);
                        $API->write('=authentication=pap,chap',false);
                        $API->write('=.id='.$row[".id"]);
                        $API->read();
                    }
                }
            }catch(\Exception $e){

            }
            try{
                $API->write('/radius/print',true);
                $READ = $API->read();
                if (array_key_exists('0',$READ)){
                    foreach($READ as $row){
                        $API->write('/radius/set',false);
                        $API->write('=address=160.19.39.4',false);
                        $API->write('=service=login,ppp',false);
                        $API->write('=src-address'.$device->ip.'=login,ppp',false);
                        $API->write('=.id='.$row[".id"]);
                        $radius = $API->read();


                    }
                }

            }catch(\Exception $e){

            }
            $API->write('/user/aaa/set',false);
            $API->write('=use-radius=yes',true);
            $radius = $API->read();


            $API->write('/ppp/active/print');
            $READ = $API->read();
            if (array_key_exists('0',$READ)){
                foreach($READ as $row){
                    echo $row['name'].' '.$row['address']."\n";
                }
            }
        }
    }

    public static function getIPAddresses($routeros_api){
        $routeros_api->write('/ip/address/print');
        return $results = $routeros_api->read();
    }


    public static function pollViaSNMP($device){
        //InterfaceLibrary::doInterfaces($device);
    }

    public static function getSNMPSystemValues($device){
        $time = time();
        \Log::info("Starting Polling for $device->ip at $time");
        $oids = array(
            "1.3.6.1.2.1.25.2.3.1.6.65536" => "used_memory",
            "1.3.6.1.2.1.25.2.3.1.5.65536" => "total_memory",
            "1.3.6.1.2.1.1.3.0" => "uptime",
        );
        $results = array();
        try {
            foreach ($oids as $oid => $description) {
                \snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
                $snmp_result = snmp2_real_walk($device->ip, $device->snmp_community, $oid);
                $results[$description] = $snmp_result;
            }
        } catch (\Exception $e) {
            Log::critical($e);
        }

        return $results;
    }

    public static function storeOrCreateRRD($data){
        $time = time();
        $files = [
            config('rrd.storage_path').$data['device_id'],
            config('rrd.storage_path')."/".$data['device_id']."/interfaces"
            ];
        foreach($files as $file){
            if(!file_exists($file)){
                exec("mkdir ".$file);
            }
        }
        $rrdfile = $files['1']."/".$data['device_interface_id'].".rrd";
        $options = array(
            '--step',config('rrd.step'),
            "--start", "-1 day",
            "DS:rxBytes:GAUGE:900:U:U",
            "DS:txBytes:GAUGE:900:U:U",
            "DS:rxMulticast:GAUGE:900:U:U",
            "DS:txMulticast:GAUGE:900:U:U",
            "DS:rxBroadcast:GAUGE:900:U:U",
            "DS:txBroadcast:GAUGE:900:U:U",
            "DS:txFCSErrors:GAUGE:900:U:U",
            "DS:rxFCSErrors:GAUGE:900:U:U",
            "DS:rxTotalCollision:GAUGE:900:U:U",
            "DS:txTotalCollision:GAUGE:900:U:U",
            "DS:rxPackets:GAUGE:900:U:U",
            "DS:txPackets:GAUGE:900:U:U",
            "DS:linkDowns:GAUGE:900:U:U",
            "DS:Availabilty:GAUGE:900:U:U",
            "RRA:".config('rrd.ds').":0.5:1:".config('rrd.rows')
        );

    }

    public static function getSystemIdentity($routeros_api){
        $routeros_api->write('/system/identity/print');
        return $results = $routeros_api->read();
    }

    public static function getSystemHealth($routeros_api){
        $routeros_api->write('/system/health/print');
        return $results = $routeros_api->read();
    }

    public static function getSystemInfo($routeros_api){
        $routeros_api->write('/system/routerboard/print');
        return $results = $routeros_api->read();
    }

    public static function getDHCPLeases($routeros_api){
        $routeros_api->write('/ip/dhcp-server/lease/print');
        return $results = $routeros_api->read();
    }

    public static function getActivePPP($routeros_api){
        $routeros_api->write('/ppp/active/print');
        return $results = $routeros_api->read();
    }

    public static function getIPNeighbors($routeros_api){
        $routeros_api->write('/ip/neighbor/print');
        return $results = $routeros_api->read();
    }

    public static function getDefaultGateways($routeros_api){
        $routeros_api->write('/ip/route/print', false);
        $routeros_api->write('?dst-address=0.0.0.0/0', true);
        return $results = $routeros_api->read();
    }

    public static function updateSystemInfo($results,$device){
        $device->description = $results["system_identity"][0]["name"];
        if(is_array($results["system_health"][0])){
            foreach($results["system_health"][0] as $key=> $health_result){
                $input[$key] = $health_result;
            }
        }
        if(is_array($results["system_info"][0])) {
            foreach ($results["system_info"][0] as $key => $info_result) {
                $input[$key] = $info_result;
            }
        }
        if(is_array($results['snmp_sys_info'])){
            foreach ($results["snmp_sys_info"] as $key => $info_result) {
                foreach($info_result as $index => $value){
                    if((preg_match('/\(.*\)/', $value, $output_array))) {
                        $final_value = preg_replace('/\(/','',$output_array[0]);
                        $final_value = preg_replace('/\)/','',$final_value);
                        $input[$key] = $final_value;
                    }else{
                        $final_value = preg_replace('/INTEGER: /','',$value);
                        $final_value = preg_replace('/\"/','',$final_value);
                        $input[$key] = $final_value;
                    }
                }
            }
        }
        $device->update($input);
        $device->save();
    }

    public static function storeSystemInfo($results,$device){
        $time = time();
        $files = [
            config('rrd.storage_path').$device->id,
            config('rrd.storage_path')."/".$device->id."/sysinfo"
        ];
        foreach($files as $file){
            if(!file_exists($file)){
                exec("mkdir ".$file);
            }
        }
        $rrdFile = $files['1']."/".$device->id.".rrd";
        if(!file_exists($rrdFile)){
            \Log::info( "NO RRD FOUND for ".$device->id);
            $options = array(
                '--step', '300',
                "--start", "-1 day",
                "RRA:MAX:0.5:1:120000"
            );
            if(!\rrd_create($rrdFile,$options)){
                echo rrd_error();
            }
        }else{
            $updator = new \RRDUpdater($rrdFile);
            $updator->update(array(

            ), $time);
        }
    }

    public static function processInterfaces($results,$device){
        $search = ".1.3.6.1.4.1.14988.1.1.14.1.1.";
        foreach ($results['interface_info'] as $key => $line) {
            $newkey = preg_split("/$search/", $key);
            $newnewkey = preg_split("/\./", $newkey['1'], 2);
            $interfaces[$newnewkey['1']][] = $line;
        }
        foreach($interfaces as $index => $interface){
            $device_interface  = MikrotikLibrary::updateOrCreateInterface($interface,$device);
            $data = array(
                "device_id" =>$device->id,
                "interface" =>$interface,
                "device_interface_id" => $device_interface->id
            );
            MikrotikLibrary::storeOrCreateRRD($data);
        }

    }

    public static function updateOrCreateDHCP($results,$device){
        $device_id = $device->id;
        foreach($results as $dhcp_lease){
            $mac_address = $dhcp_lease['mac-address'] ?? "None";
            $hostname = $dhcp_lease['host-name'] ?? "None";
            $clientname = $dhcp_lease['client_id'] ?? "None";
            $active_clientname = $dhcp_lease['active-client-id'] ?? "None";
            $expires_after = $dhcp_lease['expires-after'] ?? "None";
            $active_address = $dhcp_lease['active-address'] ?? "None";
            $active_mac_address = $dhcp_lease['active-mac-address'] ?? "None";
            $lastseen = $dhcp_lease['last-seen'] ?? "None";
            $status = $dhcp_lease['status'] ?? "None";
            $dynamic = $dhcp_lease['dynamic'] ?? "None";
            $dchplease = Dhcplease::updateOrCreate(
                ['device_id' => $device_id, 'mac_address' => $mac_address],
                [
                        "address" => $dhcp_lease['address'],
                        "mac_address" => $dhcp_lease['mac-address'],
                        "client_id" => $clientname,
                        "status" => $status,
                        "expires_after" => $expires_after,
                        "last_seen" => $lastseen,
                        "active_address" => $active_address,
                        "active_mac_address" => $active_mac_address,
                        "active_client_id" => $active_clientname,
                        "host_name" => $hostname,
                        "dynamic" => $dynamic,
                        "device_id" => $device->id
                ]
            );
        }
    }

    public static function updateOrCreateIpNeighbors($results,$device){
        $device_id = $device->id;
        foreach($results as $neighbor){
            $interface = $neighbor['interface'] ?? "None" ;
            $address = $neighbor['address'] ?? "None" ;
            $address4 = $neighbor['address4'] ?? "None" ;
            $mac_address = $neighbor['mac_address'] ?? "None" ;
            $identity = $neighbor['identity'] ?? "None" ;
            $platform = $neighbor['platform'] ?? "None" ;
            $version = $neighbor['version'] ?? "None" ;
            $unpack = $neighbor['unpack'] ?? "None" ;
            $age = $neighbor['age'] ?? "None" ;
            $uptime = $neighbor['uptime'] ?? "None" ;
            $software_id = $neighbor['software_id'] ?? "None" ;
            $board = $neighbor['board'] ?? "None" ;
            $ipv6 = $neighbor['ipv6'] ?? "None" ;
            $interface_name = $neighbor['interface_name'] ?? "None" ;
            $system_description = $neighbor['system_description'] ?? "None" ;
            $system_caps = $neighbor['system_caps'] ?? "None" ;
            $system_caps_enabled = $neighbor['system_caps_enabled'] ?? "None" ;
            $neighbor = Neighbor::updateOrCreate(
                ['device_id' => $device->id, 'address4' => $address4,'address' => $address],
                [
                    "interface" => $interface,
                    "address" => $address,
                    "address4" => $address4,
                    "mac_address" => $mac_address,
                    "identity" => $identity,
                    "platform" => $platform,
                    "version" => $version,
                    "unpack" => $unpack,
                    "age" => $age,
                    "uptime" => $uptime,
                    "software_id" => $software_id,
                    "board" => $board,
                    "ipv6" => $ipv6,
                    "interface_name" => $interface_name,
                    "system_description" => $system_description,
                    "system_caps" => $system_caps,
                    "system_caps_enabled" => $system_caps_enabled,
                    "device_id" => $device_id
                ]
            );
        }
    }

    public static function updateOrCreateActivePPP($results,$device){
        $device_id = $device->id;
        foreach($results as $ppp){
            if(array_key_exists('name',$ppp)){
                try{
                    $name = $ppp['name'];
                    $service = $ppp['service'];
                    $called_id = $ppp['caller-id'];
                    $address = $ppp['address'];
                    $radius = $ppp['radius'];
                    $uptime = $ppp['uptime'];
                }catch (\Throwable $th){
                    Log::critical($th->getMessage());
                }

                $ppp_connection = Pppconnection::updateOrCreate(
                    ['device_id' => $device->id, 'name' => $name],
                    [
                        'device_id' => $device->id,
                        'name' => $name,
                        "caller-id" => $called_id,
                        "service" => $service,
                        "address" => $address,
                        "radius" =>$radius,
                        "uptime" => $uptime,
                    ]
                );
            }
        }
    }

    public static function updateOrCreateInterface($interface,$device){
        $description = preg_split('/STRING: /',$interface['1']);
        $description = preg_replace('/\"/','',$description['1']);
        $ifindex = preg_split('/INTEGER: /',$interface['0']);
        $ifindex = preg_replace('/\"/','',$ifindex['1']);
        $deviceinterface = Deviceinterface::updateOrCreate(
            [
                'device_id' => $device->id,
                'ifindex' => $ifindex
            ],
            [
                "description" => $description,
                "device_id" => $device->id
            ]
        );
        return $deviceinterface;
    }

    public static function updateOrCreateIPAddresses($results,$device){
        foreach($results as $result) {
            if ((!strpos($result['actual-interface'], 'unit_'))) {
                $ip_address = $result['address'];
                $interface = $result['actual-interface'];
                $dynamic = $result['dynamic'];
                $disabled = $result['disabled'];
                $network = $result['network'];
                $ip = Ip::updateOrCreate(
                    [
                        'address' => $ip_address,
                        'device_id' => $device->id
                    ],
                    [
                        "address" => $ip_address,
                        "interface" => $interface,
                        "dynamic" => $dynamic,
                        "disabled" => $disabled,
                        "network" => $network,
                        "device_id" => $device->id
                    ]
                );
            }else{

            }
        }
    }

    public static function updateOrCreateDefaultGateways($results,$device){
        foreach($results as $result){
            $ip_address = $result['gateway'];
            $status = $result['gateway-status'];
            if($result['active'] =="true"){
                $active = 1;
            }else{
                $active = 0;
            }
            $disabled = $result['disabled'];
            $default_gateway = Gateway::where('ip', $ip_address)->where('device_id',$device->id)->first();
            if ($default_gateway === null) {

                $default_gateway = new Gateway([
                    'ip' => $ip_address,
                    'status'=> $status,
                    'device_id'=>$device->id,
                    'active'=>$active,
                    'disabled'=>$disabled,
                    'type' => "Internet"
                ]);
            }else{
                $default_gateway->ip = $ip_address;
                $default_gateway->status = $status;
                $default_gateway->device_id = $device->id;
                $default_gateway->active = $active;
                $default_gateway->disabled = $disabled;
                $default_gateway->type = "Internet";
            }
            $default_gateway->save();
        }
    }



}
