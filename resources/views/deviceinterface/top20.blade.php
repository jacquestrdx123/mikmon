<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Top 20 Interfaces
        </h2>
    </x-slot>
    <div>
        @livewire('deviceinterfacetop20-datatable')
    </div>

</x-app-layout>
