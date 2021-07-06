<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Events') }}
            </h2>
    </x-slot>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body"></div>
    </div>
    <div>
        @livewire('events-report-datatable')
    </div>

</x-app-layout>
