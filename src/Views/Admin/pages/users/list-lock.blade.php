@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
                        <li class="breadcrumb-item active">Hide</li>
                    </ol>
                </div>
                <h5 class="page-title">Users</h5>
            </div>
            <div class="col-md-12">
                <div class="card m-b-30">
                    <form action="" method="GET" class="mt-4 d-flex justify-content-between">
                        <div class="card-body">
                            <h2 class="mb-4">
                                <span class="badge badge-default"> Users Lock </span>
                            </h2>
                            @include('components.alert')
                            <div class="d-flex justify-content-between mb-4" style="width: 100%">
                                <div class="d-flex">
                                    <div style="margin-right: 32px">
                                        <a href="/admin/users" class="btn btn-secondary mo-mb-2" data-toggle="tooltip"
                                            data-placement="left" title=""
                                            data-original-title="List Users">
                                            <i class="dripicons-view-list"></i>
                                        </a>
                                    </div>
                                </div>
                                <div></div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Avatar</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @php $key = ($page * $perPage) - $perPage + 1; @endphp
                                        @empty($usersLock)
                                            <tr><td colspan="6" class="text-center">{{ "No user has been locked" }}</td></tr>
                                        @endempty
                                        @foreach ($usersLock as $userLock)
                                            <tr>
                                                <th>{{ $key }}</th>
                                                <td>{{ $userLock['email'] }}</td>
                                                <td>
                                                    <img
                                                        src="/assets/{{ $userLock['avatar'] }}"
                                                        alt=""
                                                        width="80"
                                                        height="80"
                                                        style=" object-fit: cover;
                                                                border-radius: 4px;
                                                                box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2);
                                                                "
                                                    >
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-default"
                                                        style=" font-size: 1rem;
                                                                @if ($userLock['role'] == 0)
                                                                font-weight: 400
                                                                @endif
                                                                "
                                                    >
                                                        
                                                        @if ($userLock['role'] == 0)
                                                            User
                                                        @else
                                                            Admin
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-danger"
                                                        style="font-size: 1rem;"
                                                    >
                                                        Lock
                                                    </span>
                                                </td>
                                                <td>
                                                    <a  href='/admin/users/unlock/{{ $userLock['id'] }}'
                                                        class='btn btn-success waves-effect waves-light'
                                                        data-toggle='tooltip'
                                                        data-placement='top'
                                                        title=''
                                                        data-original-title='Unlock'
                                                        onclick="return confirm('Unlock: {{ $userLock['email'] }} ?')"
                                                    >
                                                        <i class="mdi mdi-lock-open"></i>
                                                    </a>
                                                    
                                                </td>
                                            </tr>
                                            @php $key++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('components.table.pagination')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
