<?php

namespace App\Console\Commands;

use App\Libraries\InterfaceLibrary;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Models\Device;

class SyncInterfacesByID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncInterfacesByID {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SyncInterfaces for one Device';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $device = Device::find($this->argument('id'));
        InterfaceLibrary::syncInterfaces($device);
    }
}
