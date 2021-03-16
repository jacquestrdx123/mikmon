<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Location Info') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-header">
             Info for {!! $location->description !!}
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location Description
                    </th>
                    <th>
                        {!! $location->description !!}
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location Status
                    </th>
                    <th>
                        @if($location->status == "3")
                            <p style="color:green">Online</p>
                        @elseif($location->status =="1")
                            <p style="color:red">Offline</p>
                        @else
                            <p style="color:orange">Unstable</p>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location Devices
                    </th>
                    <th>
                       {!! sizeof($location->devices) ?? 0 !!}
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <div>
        @livewire('location-devices-datatable', ['params' => $location->id])
    </div>

</x-app-layout>
