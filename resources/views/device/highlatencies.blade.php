<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Warning Latency Report
        </h2>
    </x-slot>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-0">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong></strong></div>
                        <div class="panel-body">
                            @foreach($latencies as $index => $array)
                                <h2> {!! $index !!}</h2>
                                <table class ="table table-bordered table-hover">
                                    @foreach($array as $key => $latency)
                                        @foreach($latency as $value)
                                            <tr>
                                                <td>{!! $key !!}</td>
                                                <td>{!! $value['url'] !!}</td>
                                                <td>{!! $value['type'] !!}</td>
                                                <td>{!! $value['year'] !!}</td>
                                                <td>{!! $value['ip'] !!}</td>
                                                <td>{!! $value['value'] !!}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

