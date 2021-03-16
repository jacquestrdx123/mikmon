<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Devices') }}
    </x-slot>
    <div class="form">

        <form method="POST" action="{{ route('device.store') }}">
            @csrf

            <div class="form-group">
                <label for="first_name">Ip Address</label>
                <input type="text" class="form-control" name="ip" id="ip" placeholder="Enter IP Address">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
            </div>

            <div class="form-group">
                <label for="first_name">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="description">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="description">SNMP Community</label>
                <input type="text" class="form-control" id="snmp_community" name="snmp_community" placeholder="Enter SNMP Community">
            </div>
            @if(sizeof($locations) < 1 )
                <div class="form-group">
                    <button wire:click.prevent="cancel()" onclick="window.location.href='/locations'" class="btn btn-warning">
                        Create a location first
                    </button>
                </div>
            @else
                <div class="form-group">
                    <label class="inline-block w-32 font-bold">Location:</label>
                    <select name="location_id" wire:model="location_id" class="border shadow p-2 bg-white">
                        <option value=''>Choose a location</option>
                        @foreach($locations as $location)
                            <option value={{ $location->id }}>{{ $location->description }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label class="inline-block w-32 font-bold">Device Type:</label>
                <select name="devicetype" class="border shadow p-2 bg-white">
                    <option value=''>Choose a type</option>
                    <option value='mikrotik'>Mikrotik</option>
                    <option value='ping_only'>Other</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

</x-app-layout>
