<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Events for
            <button type="button" class="btn btn-light">
               <a href="/device/{!! $device->id !!}">
                {{$device->description}}
               </a>
            </button>

        </h2>
    </x-slot>
    <div>
        @livewire('events-datatable', ['params' => $device->id])
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {!! $event_chart->container() !!}
            @push('scripts')
                <script src="{{ $event_chart->cdn() }}"></script>
                {{ $event_chart->script() }}
            @endpush
        </div>
    </div>

</x-app-layout>
