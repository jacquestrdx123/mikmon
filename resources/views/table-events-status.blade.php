<div class="flex space-x-1 justify-around">
    @if( ($current_status > $previous_status) and ($current_status < 4))
        <p style="color:cornflowerblue">More Stable</p>
    @endif
    @if( ($current_status < $previous_status) and ($current_status > 1))
        <p style="color:orange">Less Stable</p>
    @endif
    @if( ($current_status == 4))
        <p style="color:green">Online</p>
    @endif
    @if( ($current_status == 1))
        <p style="color:red">Offline</p>
    @endif

</div>

