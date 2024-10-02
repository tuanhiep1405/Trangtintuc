@extends('layouts.master')

@section('css')
    <style>
        .settings-header {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .settings-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            position: relative;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
                <h5 class="page-title">Settings</h5>
            </div>
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="settings-header">
                                <h2 class="mt-3">Settings</h2>
                                <a
                                    href="/admin/settings/edit"
                                    class="btn btn-warning"
                                    style="position: absolute; top: 0; right: 0;"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Settings"
                                >
                                    <i class="mdi mdi-lead-pencil"></i>

                                </a>
                            </div>
                            <form action="#" method="post" enctype="multipart/form-data" style="padding: 16px 0 0;">
                                <div class="form-group d-flex justify-content-around">
                                    <div>
                                        <label for="logo" style="margin-right: 24px">Logo</label>
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ show_upload($settings['logo']) }}" alt="Logo" class="settings-avatar">
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <label for="icon" style="margin-right: 24px">Icon</label>
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ show_upload($settings['icon']) }}" alt="Icon" class="settings-avatar">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $settings['name'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $settings['email'] }}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
