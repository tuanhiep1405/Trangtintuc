@extends('layouts.master')
@section('css')
    <style>
        .label-input span {
            color: red;
        }
    </style>
@endsection
@section('content')
    <!-- 1rd Block Wrapper Start -->
    <section class="utf_block_wrapper">
        <div class="container">
            <form action="/auth/sign-up" method="POST" enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="text-center mb-4">
                            <h2>Sign Up</h2>
                        </div>
                        @include('components.alert')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="label-input">Username <span>*</span></label>
                                    <input
                                        class="form-control"
                                        placeholder="Your username..."
                                        type="text"
                                        name="name"
                                        value="{{ $_POST['name'] }}"
                                    >
                                    @include('components.error', ['name' => 'name'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="label-input">Password <span>*</span></label>
                                    <input
                                        class="form-control"
                                        placeholder="Your password..."
                                        type="password"
                                        name="password"
                                        value="{{ $_POST['password'] }}"
                                    >
                                    @include('components.error', ['name' => 'password'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="label-input">Email <span>*</span></label>
                                    <input
                                        class="form-control"
                                        placeholder="Your email..."
                                        type="email"
                                        name="email"
                                        value="{{ $_POST['email'] }}"
                                    >
                                    @include('components.error', ['name' => 'email'])
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="label-input">Confirm Password <span>*</span></label>
                                    <input
                                        class="form-control"
                                        placeholder="Confirm password..."
                                        type="password"
                                        name="confirm_password"
                                        value="{{ $_POST['confirm_password'] }}"
                                    >
                                    @include('components.error', ['name' => 'confirm_password'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="label-input">Avatar</label>
                                <div class="form-group mb-2 custom-file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <input
                                        class="custom-file-input"
                                        id="customFile"
                                        type="file"
                                        name="avatar"
                                    >
                                </div>
                                @include('components.error', ['name' => 'avatar'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <a href="/auth/"><button class="btn btn-warning" type="button">Back</button> </a>
                    <button class="btn btn-info float-right" type="submit" name="btn-sign-up">Sign Up</button>
                </div>
            </form>
        </div>
    </section>
    <!-- 1rd Block Wrapper End -->
@endsection
