<div class="flex space-x-1 justify-around">
    @if($current_status == "3")
        <p style="color:green">Online</p>
    @elseif($current_status =="1")
        <p style="color:red">Offline</p>
    @else
        <p style="color:orange">Unstable</p>
    @endif
</div>

