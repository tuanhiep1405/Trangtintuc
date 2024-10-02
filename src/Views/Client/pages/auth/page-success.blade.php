@extends('layouts.master')

@section('css')
    <style>
        .success-wrap {
            margin-bottom: 18px;
        }

        .success-code h2 {
            display: block;
            font-size: 150px;
            line-height: 150px;
            color: #23ad00;
            margin-bottom: 12px;
            font-weight: 800 !important;
        }
    </style>
@endsection

@section('content')
    <section class="utf_block_wrapper">
        <div class="container">
            <div class="row">
                <div class="success-wrap text-center col">
                    <div class="success-code">
                        <h2><strong>&#10004</strong></h2>
                    </div>
                    <div class="error-message">
                        <h4>Success</h4>
                    </div>
                    <div class="error-body">@include('components.alert')<br>
                        {!! isset($button) ? $button : '' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection