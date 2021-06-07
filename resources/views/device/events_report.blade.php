<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Event Report
        </h2>
    </x-slot>
    <div>
        @livewire('device-events-datatable')
    </div>

</x-app-layout>
