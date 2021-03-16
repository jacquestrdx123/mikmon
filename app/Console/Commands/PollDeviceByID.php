<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Models\Device;

class PollDeviceByID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PollDevice {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Poll one Device';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Device::pollDeviceByID($this->argument('id'));
    }
}
