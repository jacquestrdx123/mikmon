<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $device->description }}
        </h2>
    </x-slot>

        <div class="card">
            <div class="card-header">
                <div style="float:left">
                    <button type="button" class="btn btn-light">
                            Device Info
                    </button>
                </div>
            </div>
            <div class="card-body">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    @include('device.infotable')
                </thead>
            </table>
            <table>
                @foreach($device->gateways as $gateway)
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Device Gateway
                        </th>
                        <th>
                            {!! $gateway->status !!}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Gateway Type
                        </th>
                        <th>
                            {!! $gateway->type !!}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Is Default
                        </th>
                        <th>
                            @if($gateway->default == 1)
                                <p style="color:green">Yes</p>
                            @else
                                <p style="color:red">No</p>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Is Active
                        </th>
                        <th>
                            @if($gateway->active == 1)
                                <p style="color:green">Yes</p>
                            @else
                                <p style="color:red">No</p>
                            @endif
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
        </div>
    <div class="card">
        <div class="card-header">More Info</div>
        <div class="card-body">
                <button type="button" class="btn btn-secondary">
                    <a class="btn" href="/deviceinterface/{!! $device->id !!}">
                        View Interfaces
                    </a>
                </button>
                <button type="button" class="btn btn-warning">
                    <a class="btn" href="/device/dhcp/{!! $device->id !!}">
                        View DHCP
                    </a>
                </button>
                <button type="button" class="btn btn-success">
                    <a class="btn" href="/device/latency/{!! $device->id !!}">
                        View Latency
                    </a>
                </button>
                <button type="button" class="btn btn-primary">
                    <a class="btn" href="/device/neighbors/{!! $device->id !!}">
                        View IP Neighbors
                    </a>
                </button>
                <button type="button" class="btn btn-danger">
                    <a class="btn" href="/device/events/{!! $device->id !!}">
                        View Events
                    </a>
                </button>
        </div>
    </div>
</x-app-layout>
