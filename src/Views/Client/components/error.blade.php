<div
    style="color: red; height: 14px; width: 100%; line-height: 14px; margin-top: 4px;"
>
    @if (isset($_SESSION['error'][$name]))
        {{ $_SESSION['error'][$name] }}
        @php
            unset($_SESSION['error'][$name]);
            if(empty($_SESSION['error'])) {
                unset($_SESSION['error']);
            }
        @endphp     
    @endif
</div>