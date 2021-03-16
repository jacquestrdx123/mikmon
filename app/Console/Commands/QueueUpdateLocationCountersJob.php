<?php

namespace App\Console\Commands;

use App\Jobs\PingJob;
use App\Jobs\UpdateLocationCountersJob;
use App\Libraries\PingLibrary;
use App\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Device;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceUpdateController;
use App\Http\Controllers\DevicetypeController;


class QueueUpdateLocationCountersJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'QueueUpdateLocationCountersJob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'QueueUpdateLocationCountersJob';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       UpdateLocationCountersJob::dispatch();
    }
}
