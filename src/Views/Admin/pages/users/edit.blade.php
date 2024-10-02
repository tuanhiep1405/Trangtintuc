@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h5 class="page-title">Edit User</h5>
                
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Edit User </span>
                                </h2>
                                @include('components.alert')
                                <div class="row">
                                    <div class="col-md-3">
                                        <img
                                            src="/assets/{{ $user['avatar'] }}"
                                            alt=""
                                            width="80"
                                            height="80"
                                            style=" object-fit: cover;
                                                    border-radius: 4px;
                                                    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2);
                                                    margin-bottom: 16px
                                                    "
                                        >
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data" class="col-md-9">
                                        <div class="form-group">
                                            <label class="d-block">Email</label>
                                            <input class="form-control" type="text" name="email" value="{{ $user['email'] }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-block">Username</label>
                                            <input class="form-control" type="text" name="username" value="{{ $user['name'] }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-block" for="">Role</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select class="form-control" name="role">
                                                        <option
                                                            value="1"
                                                            {{ $user['role'] == 1 ? 'selected' : '' }}
                                                        >
                                                            Admin
                                                        </option>
                                                        <option
                                                            value="0"
                                                            {{ $user['role'] == 0 ? 'selected' : '' }}
                                                        >
                                                            User
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-success waves-effect waves-light float-right"
                                                        name="btn-update"
                                                    >
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
