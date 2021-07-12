<?php

namespace App\Console\Commands;

use App\Models\Device;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\DeviceController;


class ResetInterfaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResetInterfaces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all Interfaces Max';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Device::ResetInterfaces();
    }
}
