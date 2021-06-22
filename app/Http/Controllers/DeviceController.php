<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Event;
use App\Models\Gateway;
use App\Models\Location;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('device.index');
    }

    public function show($id){
        $device = Device::find($id);
        return view('device.show',compact('device'));
    }

    public function showEvents($id){
        $device = Device::find($id);
        return view('device.events',compact('device'));
    }

    public function showNeighbors($id){
        $device = Device::find($id);
        return view('device.neighbors',compact('device'));
    }

    public function showDHCP($id){
        $device = Device::find($id);
        return view('device.dhcp',compact('device'));
    }
    public function showIP($id){
        $device = Device::find($id);
        return view('device.ip',compact('device'));
    }

    public function getDashBoard(){
        $offline_devices = Device::where('status','1')->get();
        $events = Event::where('created_at','>',date("Y/m/d"))->take('20')->orderby('created_at','desc')->get();
        $down_main_links = Gateway::where('default','=','1')->where('active','false')->with('device')->get();
        return view('dashboard',compact('offline_devices','events','down_main_links'));
    }

    public function create(){
        $locations = Location::get();
        return view('device.create',compact('locations'));
    }

    public function store(Request $request){
       $input = $request->all();
       $device = Device::create($input);
       return redirect('/device');
    }

    public function showEventReport(){
        return  view('device.events_report');
    }

    public function showLatency($id){
        $device = Device::find($id);
        $colorarray = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000'];
        $count = 1;
        $rrdFile = config('rrd.storage_path')."/pings/" . trim($device->ip) . ".rrd";
        $result = \rrd_fetch($rrdFile, array('AVERAGE', "--resolution", 60, "--start", (time() - 186400), "--end", (time() - 350)));
        if (isset($result['data'])) {
            foreach ($result["data"] as $key => $value) {
                $labels = array();
                foreach ($value as $time => $row) {
                    $array[$key][] = $row;
                    $labels[] = $time;
                }
            }
            foreach ($labels as $value) {
                $formatted_timestamps[] = date("M-j-Y G:i", $value);
            }

            foreach ($array as $key => $row) {
                foreach ($row as $index => $value) {
                    if (is_finite($value)) {
                        $array[$key][$index] = round($value,2);
                    } else {
                        $array[$key][$index] = 0;
                    }
                }
            }

            foreach($array["packet_loss"] as $packet_loss){
                $array["availability"][] = 100 - $packet_loss;
            }
            $ping_chart = (new LarapexChart)->lineChart()
                ->setTitle('Latency Stats for '.$device->description)
                ->setSubtitle('Click to zoom')
                ->setColors($colorarray)
                ->setGrid(true)
                ->setXAxis($formatted_timestamps)
                ->setStroke(2,$colorarray)
                ->setHeight(450)
                ->setDataset([
                    [
                        'name' => 'Minimum',
                        'data'  =>  $array["min"]
                    ],
                    [
                        'name' => 'Maximum',
                        'data'  =>  $array["max"]
                    ],
                    [
                        'name' => 'Average',
                        'data'  =>  $array["avg"]
                    ],
                    [
                        'name' => 'Jitter',
                        'data'  =>  $array["jitter"]
                    ],
                    [
                        'name' => 'Packet Loss',
                        'data'  =>  $array["packet_loss"]
                    ]
                ]);
            $availability_chart = (new \LarapexChart)->setType('area')
                ->setTitle('Availability Stats for '.$device->description)
                ->setSubtitle('Click to zoom')
                ->setColors($colorarray)
                ->setGrid(true)
                ->setXAxis($formatted_timestamps)
                ->setStroke(2,$colorarray)
                ->setHeight(450)
                ->setDataset([
                    [
                        'name' => 'Availability',
                        'data'  =>  $array["availability"]
                    ],
                ]);
        }else{
            $ping_chart = (new LarapexChart)->setType('area');
        }
        if((isset($availability_chart)) AND (isset($ping_chart))){
            return view('device.latency',compact('device','ping_chart','availability_chart'));
        }else{
            return view('device.nodata',compact('device'));
        }
    }

    public function dashboardOnlineDevices(){
        $devices = Device::where('status','4')->count();
        return $devices;
    }
    public function dashboardOfflineDevices(){
        $devices = Device::where('status','1')->count();
        return $devices;
    }
    public function dashboardUnstableDevices(){
        $devices = Device::where('status','>','1')->where('status','<','4')->count();
        return $devices;
    }
    public function dashboardEvents(){
        $events = Event::where('created_at','>',date("Y/m/d"))->count();
        return $events;
    }

    public function showWarningLatencies(){
        $latencies = Device::findHourlyLatencySpikes();
        return view('device.highlatencies',compact('latencies'));
    }



}
