<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Pppconnection;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\DeviceController;


class ChangePppoe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ChangePppoe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ChangePppoe all customers';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Pppconnection::updatePPP();
    }
}
