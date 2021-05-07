<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row col-md-12">
                    <div class="col-md-3">
                        <div id="online_div" style=" height:220px"></div>
                    </div>
                    <div class="col-md-3">
                        <div id="offline_div" style=" height:220px"></div>
                    </div>
                    <div class="col-md-3">
                        <div id="unstable_div" style=" height:220px"></div>
                    </div>
                    <div class="col-md-3">
                        <div id="events_div" style=" height:220px"></div>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">Offline Devices</div>
                                <div class="container mt-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center activity">
                                                <div><i class="fa fa-clock-o"></i><span class="ml-2">11h 25m</span></div>
                                                <div><span class="activity-done">Done Activities(4)</span></div>
                                                <div class="icons"><i class="fa fa-search"></i><i class="fa fa-ellipsis-h"></i></div>
                                            </div>
                                            <div class="mt-3">
                                                <ul class="list list-inline">
                                                    @foreach($offline_devices as $offline_device)
                                                        <li>
                                                            <card>

                                                            </card>
                                                        </li>
                                                        <li class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                                                <div class="ml-2">
                                                                    <h6 class="mb-0">{!! $device->location->description !!}</h6>
                                                                    <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                                                        <a href="/device/{!! $offline_device->id !!}">
                                                                            {!! $offline_device->description !!}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">Something here </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="card-header">Recent Events</div>
                            <ul>
                                @foreach($events as $event)
                                    @if( ($event->current_status == 4))
                                        <li style="color:green">
                                            {!! $event->getRemoteObject()->ip !!} came back Online
                                        </li>
                                    @endif
                                    @if( ($event->current_status == 1))
                                        <li style="color:red">
                                            {!! $event->getRemoteObject()->ip !!} went Offline
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function getOfflineDevices(){
                var offlineDevices = new JustGage({
                    id: "offline_div",
                    value: 0,
                    min: 0,
                    max: 100,
                    title: "Down Devices"
                });

                $.ajax({
                    url: '/dashboard/offlinedevices',                  //the script to call to get data
                    data: "",                        //you can insert url arguments here to pass to api.php
                                                     //for example "id=5&parent=6"
                    dataType: 'json',                //data format
                    success: function(data)          //on receive of reply
                    {
                        offlineDevices.refresh(data);
                    }
                });

                setInterval(function() {
                    $.ajax({
                        url: '/dashboard/offlinedevices',                  //the script to call to get data
                        data: "",                        //you can insert url arguments here to pass to api.php
                                                         //for example "id=5&parent=6"
                        dataType: 'json',                //data format
                        success: function(data)          //on receive of reply
                        {
                            offlineDevices.refresh(data);
                        }
                    });
                }, 30000);
            }
            function getOnlineDevices(){
                var onlineDevices = new JustGage({
                    id: "online_div",
                    value: 0,
                    min: 0,
                    max: 250,
                    levelColors:["#ff0000","#a9d70b", "#45d70b"],
                    title: "Online Devices"
                });

                $.ajax({
                    url: '/dashboard/onlinedevices',                  //the script to call to get data
                    data: "",                        //you can insert url arguments here to pass to api.php
                                                     //for example "id=5&parent=6"
                    dataType: 'json',                //data format
                    success: function(data)          //on receive of reply
                    {
                        onlineDevices.refresh(data);
                    }
                });

                setInterval(function() {
                    $.ajax({
                        url: '/dashboard/onlinedevices',                  //the script to call to get data
                        data: "",                        //you can insert url arguments here to pass to api.php
                                                         //for example "id=5&parent=6"
                        dataType: 'json',                //data format
                        success: function(data)          //on receive of reply
                        {
                            onlineDevices.refresh(data);
                        }
                    });
                }, 30000);
            }
            function getUnstableDevices(){
                var unstableDevices = new JustGage({
                    id: "unstable_div",
                    value: 0,
                    min: 0,
                    max: 100,
                    title: "Unstable Devices"
                });

                $.ajax({
                    url: '/dashboard/unstabledevices',                  //the script to call to get data
                    data: "",                        //you can insert url arguments here to pass to api.php
                                                     //for example "id=5&parent=6"
                    dataType: 'json',                //data format
                    success: function(data)          //on receive of reply
                    {
                        unstableDevices.refresh(data);
                    }
                });

                setInterval(function() {
                    $.ajax({
                        url: '/dashboard/unstabledevices',                  //the script to call to get data
                        data: "",                        //you can insert url arguments here to pass to api.php
                                                         //for example "id=5&parent=6"
                        dataType: 'json',                //data format
                        success: function(data)          //on receive of reply
                        {
                            unstableDevices.refresh(data);
                        }
                    });
                }, 30000);
            }
            function getEvents(){
                var events = new JustGage({
                    id: "events_div",
                    value: 0,
                    min: 0,
                    max: 100,
                    title: "Events Today"
                });

                $.ajax({
                    url: '/dashboard/events',                  //the script to call to get data
                    data: "",                        //you can insert url arguments here to pass to api.php
                                                     //for example "id=5&parent=6"
                    dataType: 'json',                //data format
                    success: function(data)          //on receive of reply
                    {
                        events.refresh(data);
                    }
                });
                setInterval(function() {
                    $.ajax({
                        url: '/dashboard/events',                  //the script to call to get data
                        data: "",                        //you can insert url arguments here to pass to api.php
                                                         //for example "id=5&parent=6"
                        dataType: 'json',                //data format
                        success: function(data)          //on receive of reply
                        {
                            events.refresh(data);
                        }
                    });
                }, 30000);
            }

            getOfflineDevices();
            getOnlineDevices();
            getUnstableDevices();
            getEvents();

        </script>
    @endpush
</x-app-layout>
