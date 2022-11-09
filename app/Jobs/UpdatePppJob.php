<?php

namespace App\Jobs;

use App\Libraries\PingLibrary;
use App\Models\Pppconnection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePppJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $ppp;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ppp)
    {
        $this->ppp = $ppp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $key =  $this->ppp[0];
        $customer = $this->ppp[1];
        $pppConnection = Pppconnection::where('name',$key)->first();
        if(isset($pppConnection->address)){
            try{
                $command = '/interface pppoe-client set user='.$customer.' password=s1mplyw1r3l3ss numbers=[find user='.$key.']';
                $connection = ssh2_connect($pppConnection->address, 22);
                ssh2_auth_password($connection, 'admin', '345y1c0m5');
                $stream = ssh2_exec($connection, $command);

                $command = '/interface pppoe-client set allow=pap,chap numbers=0';
                $connection = ssh2_connect($pppConnection->address, 22);
                ssh2_auth_password($connection, 'admin', '345y1c0m5');
                $stream = ssh2_exec($connection, $command);
                ssh2_disconnect($connection);
            }catch (\Exception $e){
                echo "Failed on ".$pppConnection->address."\n";
            }

        }else{
            echo $key ." Not Found \n";
        }
    }
}
