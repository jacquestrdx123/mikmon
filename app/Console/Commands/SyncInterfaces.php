<?php

namespace App\Console\Commands;

use App\Models\Device;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\DeviceController;


class SyncInterfaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncInterfaces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Poll all Devices';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Device::SyncInterfaces();
    }
}
