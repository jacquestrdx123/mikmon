<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('IP Addresses') }}
        </h2>
    </x-slot>
    <div>
        @livewire('ipaddress-datatable')
    </div>

</x-app-layout>
