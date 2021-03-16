<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Interfaces for
            <button type="button" class="btn btn-light">
               <a href="/device/{!! $device->id !!}">
                {{$device->description}}
               </a>
            </button>

        </h2>
    </x-slot>
    <div>
        @livewire('dhcp-datatable', ['params' => $device->id])
    </div>

</x-app-layout>
