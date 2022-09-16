<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PPP Connections') }}
        </h2>
    </x-slot>
    <div>
        @livewire('allppp-datatable')
    </div>

</x-app-layout>
