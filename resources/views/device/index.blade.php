<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Devices') }}
            </h2>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary">
                <a href="/device/create">
                    Add Device
                </a>
            </button>
        </div>
        <div class="card-body"></div>
    </div>
    <div>
        @livewire('device-datatable')
    </div>

</x-app-layout>
