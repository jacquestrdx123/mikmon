<?php

namespace App\Jobs;

use App\Libraries\InterfaceLibrary;
use App\Libraries\PingLibrary;
use App\Models\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InterfaceSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $device;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($device)
    {
        $this->device= $device;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info("Starting PollWorker for ".$this->device->ip);
            InterfaceLibrary::syncInterfaces($this->device);
        \Log::info("Finished PollWorker for ".$this->device->ip);

    }
}
