
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Device IP
    </th>
    <th>
        {!! $device->ip !!}
    </th>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Device Description
    </th>
    <th>
        {!! $device->description !!}
    </th>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Device Location
    </th>
    <th><a href="/location/{!! $device->location_id !!}">{!! $device->location->description !!}</a></th>
</tr>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Device Model
    </th>
    <th>{!! $device->model !!}</th>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Device Serial Nr
    </th>
    <th>{!! $device->{'serial-number'} !!}</th>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Current Firmware
    </th>
    <th>{!! $device->{'current-firmware'} !!}</th>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Upgrade Firmware
    </th>
    <th>{!! $device->{'upgrade-firmware'} !!}</th>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Device Status
    </th>
    <th>
        @if($device->current_status =="Online")
            <p style="color:green">Online</p>
        @elseif($device->current_status =="Offline")
            <p style="color:red">Offline</p>
        @else
            <p style="color:orange">Unstable</p>
        @endif
    </th>
</tr>
@foreach($device->gateways as $gateway)
    @if($gateway->active == "true")
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
    @endif
@endforeach
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Last Online
    </th>
    <th>{!! $device->{'last_online'} !!}</th>
</tr>
<tr>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Last Offline
    </th>
    <th>{!! $device->{'last_offline'} !!}</th>
</tr>
@if($device->{'fan-mode'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Fan Mode
        </th>
        <th>
            {!! $device->{'fan-mode'} !!}
        </th>
    </tr>
@endif
@if($device->{'use-fan'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Use Fan
        </th>
        <th>
            {!! $device->{'use-fan'} !!}
        </th>
    </tr>
@endif
@if($device->{'active-fan'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Active Fan
        </th>
        <th>
            {!! $device->{'active-fan'} !!}
        </th>
    </tr>
@endif
@if($device->{'cpu-overtemp-check'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            CPU Overtemp Check
        </th>
        <th>
           {!! $device->{'cpu-overtemp-check'} !!}
        </th>
    </tr>
@endif
@if($device->{'cpu-overtemp-threshold'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            CPU Overtemp Threshold
        </th>
        <th>
            {!! $device->{'cpu-overtemp-threshold'} !!}
        </th>
    </tr>
@endif
@if($device->{'voltage'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Device Voltage
        </th>
        <th>
            {!! $device->{'voltage'} !!} V
        </th>
    </tr>
@endif
@if($device->{'current'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Device Current
        </th>
        <th>
           {!! $device->current !!}
        </th>
    </tr>
@endif
@if($device->{'temperature'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Device Temperature
        </th>
        <th>
            {!! $device->temperature !!} C
        </th>
    </tr>
@endif
@if($device->{'cpu-temperature'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            CPU Temp
        </th>
        <th>
            {!! $device->{'cpu-temperature'} !!}
        </th>
    </tr>
@endif
@if($device->{'power-consumption'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Power Consumption
        </th>
        <th>
            {!! $device->{'power-consumption'} !!}
        </th>
    </tr>
@endif
@if($device->{'fan1-speed'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Fan 1 Speed
        </th>
        <th>
           {!! $device->{'fan1-speed'} !!}
        </th>
    </tr>
@endif
@if($device->{'fan2-speed'} == 0)
@else
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Fan 2 Speed
        </th>
        <th>
            {!! $device->{'fan2-speed'} !!}
        </th>
    </tr>
@endif
