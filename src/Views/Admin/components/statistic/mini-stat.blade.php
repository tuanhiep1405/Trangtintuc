<div class="col-md-3">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="@php echo isset($icon) ? $icon : 'mdi mdi-cube-outline ' @endphp float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0">{{ $title }}</h6>
        </div>
        <div class="card-body">
            <div class="mt-4 text-muted">
                <h5 class="m-0">
                    {{ $quantity }}
                </h5>
            </div>
        </div>
    </div>
</div>
