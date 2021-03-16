<div class="flex space-x-1 justify-around">
    @if($current_status == "Online")
        <p style="color:green">Online</p>
    @elseif($current_status =="Offline")
        <p style="color:red">Offline</p>
    @else
        <p style="color:orange">Unstable</p>
    @endif
</div>

