@extends('layouts.master')

@section('css')
<style>
    .settings-header {
      text-align: center;
      margin: 20px 0;
    }
    .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      position: relative;
    }
    .upload-logo, .upload-icon {
      position: absolute;
      top: 0;
      left: 0;
      width: 80px;
      height: 80px;
      background: rgba(0, 0, 0, 0.5);
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s;
      border-radius: 50%;
      cursor: pointer;
    }
    .settings-avatar:hover .upload-logo {
      opacity: 1;
    }

    .settings-icon:hover .upload-icon {
      opacity: 1;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .upload-input {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      opacity: 0;
      cursor: pointer;
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
                            <li class="breadcrumb-item"><a href="/admin/settings">Settings</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h5 class="page-title">Settings Edit</h5>
            </div>
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="settings-header">
                                <h2 class="mt-3">Settings</h2>
                            </div>
                        @include('components.alert')
                            <form action="#" method="post" enctype="multipart/form-data" style="padding: 16px 0 0;">
                                <div class="form-group d-flex justify-content-around ">
                                    <div class="settings-avatar">
                                        <label for="logo" style="margin-right: 24px">Logo</label>
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ show_upload($settings['logo']) }}"  name = "logo" alt="Logo" class="avatar">
                                            <div class="upload-logo">
                                                <i class="mdi mdi-camera" style="font-size: 2rem;"></i>
                                                <input type="file" class="upload-input" id="logo" name="logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings-icon">
                                        <label for="icon" style="margin-right: 24px">Icon</label>
                                        <div class="position-relative d-inline-block settings-icon">
                                            <img  src="{{ show_upload($settings['icon']) }}" name = "icon" alt="Icon" class="avatar">
                                            <div class="upload-icon">
                                                <i class="mdi mdi-camera" style="font-size: 2rem;"></i>
                                                <input type="file" class="upload-input" id="icon" name="icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $settings['name'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $settings['email'] }}">
                                </div>
                                <button type="submit" class="btn btn-success float-right">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection