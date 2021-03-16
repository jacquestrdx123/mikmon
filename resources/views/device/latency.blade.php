<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Latency statistics for
            <button type="button" class="btn btn-light">
                <a href="/device/{!! $device->id !!}">
                    {{$device->description}}
                </a>
            </button>

        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {!! $ping_chart->container() !!}
        {!! $availability_chart->container() !!}
        @push('scripts')
            <script src="{{ $ping_chart->cdn() }}"></script>
            {{ $ping_chart->script() }}
            {{ $availability_chart->script() }}
        @endpush
    </div>
</div>
</x-app-layout>
