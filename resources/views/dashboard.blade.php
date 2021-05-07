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
                                <div class="card-header border">Offline Devices</div>
                                <ul class="list-group-flush">
                                    @if (!$offline_devices->isEmpty())
                                    @foreach($offline_devices as $offline_device)
                                        <li class="list-group-item list-group-item-danger">
                                            <a href="/device/{!! $offline_device->id !!}">
                                                {!! $offline_device->description !!} - Offline for {!! $offline_device->getDownTime() !!}
                                            </a>
                                        </li>
                                    @endforeach
                                    @else
                                        <li>
                                            No Offline Devices!!
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header border">Something here </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="card-header border">Recent Events</div>

                            <ul class="list-group-flush">
                                @foreach($events as $event)
                                    @if( ($event->current_status == 4))
                                        <li class="list-group-item list-group-item-success">
                                            {!! $event->getRemoteObject()->description !!} came back Online at {!! $event->created_at !!}
                                        </li>
                                    @endif
                                    @if( ($event->current_status == 1))
                                        <li class="list-group-item list-group-item-danger">
                                            {!! $event->getRemoteObject()->description !!} went Offline at {!! $event->created_at !!}
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
