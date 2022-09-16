<?php

namespace App\Console\Commands;

use App\Models\Device;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\DeviceController;


class FixConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FixConfig';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'FixConfig all Devices';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Device::FixConfig();
    }
}
