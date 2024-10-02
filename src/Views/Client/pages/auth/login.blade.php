@extends('layouts.master')

@section('content')
    <!-- 1rd Block Wrapper Start -->
    <section class="utf_block_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mrb-40">
                    <div class="text-center">
                        <h3>Login</h3>

                    </div>
                    <div class="d-flex no-block justify-content-center align-items-center">
                        <form action="" method="POST">
                            @include('components.alert')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            class="form-control"
                                            placeholder="Email*"
                                            type="email"
                                            name="email"
                                            value="{{ $_POST['email'] }}"
                                        >
                                        @include('components.error', ['name' => 'email'])
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            class="form-control form-control-lg"
                                            placeholder="Password*"
                                            type="password"
                                            name="password"
                                        >
                                        @include('components.error', ['name' => 'password'])
                                    </div>
                                </div>
                            </div>
                            <a href="/auth/forgot-password" style="color: rgb(118, 118, 4); font-weight: 700;">Forgort Password?</a>

                            <div class="clearfix mt-2">
                                <a href="/auth/sign-up">
                                    <button class="btn btn-info" type="button">Sign Up?</button>
                                </a>
                                <button class="btn btn-success float-right" type="submit" name="btn-login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 1rd Block Wrapper End -->
@endsection

@section('js')

    <script>
        const thongBao =
        `@php
            echo isset($_GET['thongbao']) ? $_GET['thongbao'] : false
        @endphp`;

        if(thongBao) {
            window.addEventListener('load', function() {
                alert(thongBao);
                
                setTimeout(() => {
                    const url = new URL(window.location);
                    url.searchParams.delete('thongbao');
                    window.history.pushState(null, '', url);
                }, 1);
            });
        }
    </script>
    
@endsection
