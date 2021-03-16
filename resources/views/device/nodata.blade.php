<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $device->description }}
        </h2>
    </x-slot>

    <div class="py-12">
        <p> No data for {!! $device->description !!}</p>
    </div>
</x-app-layout>
