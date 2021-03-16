<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Statistics for {{$dinterface->name}}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {!! $throughputChart->container() !!}
            {!! $interfaceErrorsChart->container() !!}
            {!! $interfaceUptimeChart->container() !!}
            @push('scripts')
                <script src="{{ $interfaceErrorsChart->cdn() }}"></script>
                {{ $throughputChart->script() }}
                {{ $interfaceErrorsChart->script() }}
                {!! $interfaceUptimeChart->script() !!}

            @endpush
        </div>
    </div>

</x-app-layout>
