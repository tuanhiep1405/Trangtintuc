@extends('layouts.master')

@section('css')
    <style>
        .profile-header {
            position: relative;
            text-align: center;
            margin: 20px 0;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
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
                        <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
            <h5 class="page-title">Profile</h5>
        </div>
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="profile-header">
                        <img src="/assets/{{ $_SESSION['user']['avatar'] }}" alt="Avatar" class="profile-avatar">
                        <a
                            href="/admin/profile/edit"
                            class="btn btn-warning"
                            style="position: absolute; top: 0; right: 0;"
                            data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Profile"
                        >
                            <i class="mdi mdi-lead-pencil"></i>

                        </a>
                        <h2 class="mt-3">{{ $_SESSION['user']['name'] }}</h2>
                        <p class="text-muted">{{ $_SESSION['user']['email'] }}</p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Tổng số bài đăng</span>
                            <span class="badge badge-primary">{{ $totalPost }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Tổng số bình luận</span>
                            <span class="badge badge-primary">{{ $totalComment }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Vai trò</span>
                            <span >{{ $_SESSION['user']['role'] === 1 ? 'Admin' : '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Created at</span>
                            <span>{{ $_SESSION['user']['created_at'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Updated at</span>
                            <span>{{ $_SESSION['user']['updated_at'] }}</span>
                        </li>
                    </ul>
                </div>
                </div>
          </div>
        </div>
    
    </div>
</div>
@endsection