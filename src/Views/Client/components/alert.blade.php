@if (isset($_SESSION['notify']))

    @php    
        $arrayStatus = array_keys($_SESSION['notify']);
    @endphp

    @foreach ($arrayStatus as $status)
        @foreach ($_SESSION['notify'][$status] as $text)
            <div class="alert alert-{{ $status }} mb-4" role="alert">
                <strong style="text-transform: capitalize" >
                    {{ 
                        ($status == 'success' || $status == 'warning') 
                        ? $status 
                        : ( $status == 'danger' ? 'error' : '' )
                    }}: 
                </strong>
                {{ $text }}
            </div>
        @endforeach
        
    @endforeach

    @php
        unset($_SESSION['notify']);
    @endphp

@endif