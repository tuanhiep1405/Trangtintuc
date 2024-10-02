@extends('layouts.master')
@section('content')
    <!-- 1rd Block Wrapper Start -->
    <section class="utf_block_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mrb-40">
                    <div class="text-center">
                        <h3>Enter your new password for {{ $_GET['email'] }}</h3>
                        <div class="d-flex no-block justify-content-center align-items-center">
                            <form action="" method="POST" style="width: 450px;">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-4">
                                        <div class="text-left">New Password</div>
                                        <input
                                            class="form-control"
                                            placeholder="Your password..."
                                            type="password"
                                            name="password"
                                            value="{{ $_POST['password'] }}"
                                            style="width: 100%;"
                                        >
                                        <div class="text-left">
                                            @include('components.error', ['name' => 'password'])
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group mb-2">
                                        <div class="text-left">Confirm New Password</div>
                                        <input
                                            class="form-control"
                                            placeholder="Confirm password..."
                                            type="password"
                                            name="confirm_password"
                                            value="{{ $_POST['confirm_password'] }}"
                                            style="width: 100%;"
                                        >
                                        <div class="text-left">
                                            @include('components.error', ['name' => 'confirm_password'])
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-submit float-right" type="submit" name="btn-ok">OK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 1rd Block Wrapper End -->
@endsection
