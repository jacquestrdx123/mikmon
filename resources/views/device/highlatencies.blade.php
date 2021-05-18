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
                                <button class="btn btn-default collapsible">
                                        <strong> Latency Events for {!! $index !!} &nbsp &nbsp : &nbsp &nbsp{!! sizeof(reset($array)) !!}   </strong>
                                </button>
                                <div class="content">
                                    <ul class="nav navbar-default">
                                    <li>
                                        <table class ="table table-bordered table-hover">
                                            {!! dd(sizeof($array[$index])) !!}
                                                @foreach($array as $key => $latency)
                                                    @foreach($latency as $value)
                                                        <tr style="color:red">
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
                                    </li>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
        <style>
            .collapsible {
                color: #444;
                padding: 18px;
                width: 100%;
            }
            .collapsible:after {
                content: '\02795'; /* Unicode character for "plus" sign (+) */
                font-size: 13px;
                color: white;
                float: right;
                margin-left: 5px;
            }

            .active:after {
                content: "\2796"; /* Unicode character for "minus" sign (-) */
            }

            /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
            .active, .collapsible:hover {
                background-color: #ccc;
            }

            /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
            .active, .collapsible:hover {
                background-color: #ccc;
            }

            .content {
                padding: 0 18px;
                background-color: white;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.2s ease-out;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.maxHeight){
                        content.style.maxHeight = null;
                        console.log("Hiding Something");
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                        console.log("Showing Something");
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>

