@extends('layouts.master')

@section('css')
    <style>
        .profile-header {
            text-align: center;
            margin: 20px 0;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            position: relative;
        }

        .upload-icon {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 50%;
        }

        .profile-avatar:hover .upload-icon {
            opacity: 1;
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
                        <li class="breadcrumb-item"><a href="/admin/profile">Profile</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h5 class="page-title">Profile</h5>
            </div>
            <div class="col-md-12">
                <div class="container">
                    <form action="/admin/profile/edit" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="profile-header">
                                    <div class="position-relative d-inline-block profile-avatar">
                                        <img src="/assets/{{ $_SESSION['user']['avatar'] }}" alt="Avatar" class="avatar">
                                        <div class="upload-icon">
                                            <input
                                                type="file"
                                                style="opacity:0; position:absolute; top:0; left:0; bottom:0; right:0; cursor:pointer;"
                                                name="avatar"
                                            >
                                            <i class="mdi mdi-camera" style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                    <h4 class="mt-3">{{ $_SESSION['user']['email'] }}</h4>
                                    @include('components.alert')
                                </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            value="{{ $_SESSION['user']['name'] }}"
                                        >
                                    </div>
                                    <button type="submit" class="btn btn-success float-right" name="btn-save">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
