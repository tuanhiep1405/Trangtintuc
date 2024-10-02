@extends('layouts.master')

@section('content')
    <section class="utf_block_wrapper">
        <div class="container">
            <div class="row">
                <div class="error-page text-center col">
                    <div class="error-code">
                        <h2><strong>&#x2716</strong></h2>
                    </div>
                    <div class="error-message">
                        <h3>Fails</h3>
                    </div>
                    <div class="error-body">@include('components.alert')<br>
                        <a href="/" class="btn btn-primary">Back to Home</a> 
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection