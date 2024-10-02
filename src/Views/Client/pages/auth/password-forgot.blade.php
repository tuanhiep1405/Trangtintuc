@extends('layouts.master')
@section('content')
    <!-- 1rd Block Wrapper Start -->
    <section class="utf_block_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mrb-40">
                    <div class="text-center">
                        <h3 class="mb-4">Enter your email to password restore</h3>
                        @include('components.alert')
                        <div class="d-flex no-block justify-content-center align-items-center">
                            <form action="/auth/forgot-password" method="POST">
                                <div class="row mb-1">
                                    <div class="form-group mb-2">
                                        <input
                                            class="form-control"
                                            placeholder="Your email..."
                                            type="email"
                                            name="email"
                                            style="width: 350px"
                                            value="{{ $_POST['email'] }}"
                                        >
                                        <div class="text-left">
                                            @include('components.error', ['name' => 'email'])
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="btn-continue">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 1rd Block Wrapper End -->
@endsection
