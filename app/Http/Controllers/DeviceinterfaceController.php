<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Deviceinterface;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;

class DeviceinterfaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $device = Device::find($id);
        return view('deviceinterface.index',compact('device'));
    }

        public function show($id){
            $dinterface = Deviceinterface::find($id);
            $colorarray = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000'];
            $step = 300;
            $start = time() - (7 * 24 * 60 * 60);
            $end = time();
            $packets_array = array();
            $finals = array();
            $rrdFile =  "/var/www/html/mikmon/storage/rrd/".$dinterface->device_id."/interfaces/".$dinterface->default_name.".rrd";
            try {
                $result = \rrd_fetch($rrdFile, array('AVERAGE', "--resolution", 300, "--start", (time() - 186400), "--end", (time() - 350)));
                if(isset($result['data'])) {
                    foreach ($result["data"]["rxvalue"] as $key => $value) {
                        $labels[] = $key;
                    }
                    foreach ($result["data"]["rxvalue"] as $key => $value) {
                        if (is_finite($value)) {
                            $array['rxvalue'][] = $value;
                        } else {
                            $array['rxvalue'][] = 0;
                        }
                    }
                    foreach ($result["data"]["Availabilty"] as $key => $value) {
                        if (is_finite($value)) {
                            $array['availabilty'][] = $value;

                        } else {
                            $array['availabilty'][] = 0;
                        }
                    }
                    foreach ($result["data"]["txvalue"] as $key => $value) {
                        if (is_finite($value)) {
                            $array['txvalue'][] = $value;
                        } else {
                            $array['txvalue'][] = 0;
                        }
                    }
                    foreach ($result["data"]["ifInErrors"] as $key => $value) {
                        if (is_finite($value)) {
                            $array['ifInErrors'][] = $value;
                        } else {
                            $array['ifInErrors'][] = 0;
                        }
                    }
                    foreach ($result["data"]["ifOutErrors"] as $key => $value) {
                        if (is_finite($value)) {
                            $array['ifOutErrors'][] = $value;
                        } else {
                            $array['ifOutErrors'][] = 0;
                        }
                    }

                    foreach ($labels as $key => $value) {
                        if (isset($labels[$key + 1])) {
                            $array['timestamps'][] = $labels[$key + 1] - $value;
                        }
                    }
                    foreach ($labels as $value) {
                        $formatted_timestamps[] = date("F-j-Y g:i a", $value);
                    }

                    foreach ($labels as $value) {
                        $formatted_timestamps_throughput[] = date("F-j-Y g:i a", $value);
                    }


                    foreach ($array['ifInErrors'] as $key => $value) {
                        if (isset($array['ifInErrors'][$key + 1])) {
                            $error_array['ifInErrors'][] = $array['ifInErrors'][$key + 1] - $value;
                        }
                    }

                    foreach ($array['ifOutErrors'] as $key => $value) {
                        if (isset($array['ifOutErrors'][$key + 1])) {
                            $error_array['ifOutErrors'][] = $array['ifOutErrors'][$key + 1] - $value;
                        }
                    }

                    foreach ($array['rxvalue'] as $key => $value) {
                        if (isset($array['rxvalue'][$key + 1])) {
                            if (($array['rxvalue'][$key + 1] == 0) or ($value == 0) or ($array['rxvalue'][$key + 1] == $value)) {
                                $finals['rxvalue'][] = 0;
                            }else{
                                $rxvalue = $array['rxvalue'][$key + 1] - $value;
                                if($rxvalue<0){
//                                    $rxvalue = 4147412756088 - $array['txvalue'][$key] + $array['txvalue'][$key+1];
//                                    $final = round($rxvalue * 8 / $array['timestamps'][$key] / 1024 / 1024, 2);
//                                    $finals['rxvalue'][] = $final;
                                    $final = round($rxvalue * 8 / $array['timestamps'][$key] / 1024 / 1024, 2);
                                    if(($final > 1000) or ($final < 0)){
                                        $final=0;
                                    }
                                    $finals['rxvalue'][] = $final;
                                }else{
                                    $final = round($rxvalue * 8 / $array['timestamps'][$key] / 1024 / 1024, 2);
                                    $finals['rxvalue'][] = $final;
                                }
                            }
                        }
                    }
                    foreach ($array['txvalue'] as $key => $value) {
                        if (isset($array['txvalue'][$key + 1])) {
                            if (($array['txvalue'][$key + 1] == 0) or ($value == 0) or ($array['txvalue'][$key + 1] == $value)) {
                                $finals['txvalue'][] = 0;
                            } elseif(($array['txvalue'][$key] - $array['txvalue'][$key + 1]) > 0) {
                                $txvalue = 4147412756088 - $array['txvalue'][$key] + $array['txvalue'][$key+1];
                                $final = round($txvalue * 8 / $array['timestamps'][$key] / 1024 / 1024, 2);
                                if(($final > 1000) or ($final < 0)){
                                    $final=0;
                                }
                                $finals['txvalue'][] = $final;

                            }else{
                                $txvalue = $array['txvalue'][$key + 1] - $value;
                                $final = round($txvalue * 8 / $array['timestamps'][$key] / 1024 / 1024, 2);
                                if(($final > 1000) or ($final < 0)){
                                    $final=0;
                                }
                                $finals['txvalue'][] = $final;
                            }
                        }
                    }

                    $throughputChart = (new LarapexChart)->setType('area')
                        ->setTitle('Throughput Stats for '.$dinterface->name)
                        ->setSubtitle('Click to zoom')
                        ->setColors($colorarray)
                        ->setGrid(true)
                        ->setXAxis($formatted_timestamps)
                        ->setStroke(2,$colorarray)
                        ->setHeight(450)
                        ->setDataset([
                            [
                                'name' => 'TX Rate (Mbps)',
                                'data'  =>  $finals["txvalue"]
                            ],
                            [
                                'name' => 'RX Rate (Mbps)',
                                'data'  =>  $finals["rxvalue"]
                            ],

                        ]);

                    $interfaceErrorsChart = (new LarapexChart)->setType('line')
                        ->setTitle('Error Stats for '.$dinterface->name)
                        ->setSubtitle('Click to zoom')
                        ->setColors($colorarray)
                        ->setGrid(true)
                        ->setXAxis($formatted_timestamps)
                        ->setStroke(2,$colorarray)
                        ->setHeight(450)
                        ->setDataset([
                            [
                                'name' => 'In Errors ',
                                'data'  =>  $error_array["ifInErrors"]
                            ],
                            [
                                'name' => 'Out Errors',
                                'data'  =>  $error_array["ifOutErrors"]
                            ],
                        ]);

                    $interfaceUptimeChart = (new LarapexChart)->setType('bar')
                        ->setTitle('Uptime Stats for '.$dinterface->name)
                        ->setSubtitle('Click to zoom')
                        ->setColors($colorarray)
                        ->setGrid(true)
                        ->setXAxis($formatted_timestamps)
                        ->setStroke(1,$colorarray)
                        ->setHeight(450)
                        ->setDataset([
                            [
                                'name' => 'Uptime %',
                                'data'  =>  $array["availabilty"]
                            ],
                        ]);

                    return view('deviceinterface.show', compact( 'dinterface','throughputChart','interfaceErrorsChart','interfaceUptimeChart'));
                }else{
                    return view('deviceinterface.show', compact( 'dinterface'));
                }
            } catch (Exception $e) {
            }
        }

}
