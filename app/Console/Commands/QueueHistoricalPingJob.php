<?php

namespace App\Console\Commands;

use App\Jobs\PingHistoricalJob;
use App\Jobs\PingJob;
use App\Libraries\PingLibrary;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Device;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceUpdateController;
use App\Http\Controllers\DevicetypeController;


class QueueHistoricalPingJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'QueueHistoricalPingJob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'QueueHistoricalPingJob';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       PingLibrary::StoreHistoricalPings();
    }
}
