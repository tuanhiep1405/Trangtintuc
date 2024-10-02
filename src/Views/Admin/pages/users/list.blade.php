@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                <h5 class="page-title">Users</h5>
            </div>
            <div class="col-md-12">
                <div class="card m-b-30">
                    <form action="" method="GET" class="mt-4 d-flex justify-content-between">
                        <div class="card-body">
                            <h2 class="mb-4">
                                <span class="badge badge-default"> Users </span>
                            </h2>

                            @include('components.alert')

                            <div class="d-flex justify-content-between mb-4" style="width: 100%">
                                <div class="d-flex">
                                    <div style="margin-right: 32px">
                                        <a href="/admin/users/list-lock" class="btn btn-danger mo-mb-2" data-toggle="tooltip"
                                            data-placement="top" title=""
                                            data-original-title="List Users Lock">
                                            <i class="mdi mdi-account-off"></i>
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
                                        @foreach ($users as $index => $user)
                                            @empty($users)
                                                <tr>
                                                    <td colspan="6" class="text-center">No User Here</td>
                                                </tr>
                                            @endempty
                                            <tr>
                                                <th>{{ $key }}</th>
                                                <td>{{ $user['email'] }}</td>
                                                <td>
                                                    <img
                                                        src="/assets/{{ $user['avatar'] }}"
                                                        alt="user-image"
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
                                                                @if ($user['role'] == 0)
                                                                font-weight: 400
                                                                @endif
                                                                "
                                                    >
                                                        
                                                        @if ($user['role'] == 0)
                                                            User
                                                        @else
                                                            Admin
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-@if ($user['status'] == 1)warning
                                                                            @elseif ($user['status'] == 2)success
                                                                            @endif
                                                                "
                                                        style="font-size: 1rem;"
                                                    >
                                                        @if ($user['status'] == 1)
                                                            Wait Activation
                                                        @elseif ($user['status'] == 2)
                                                            Active
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <a  href='/admin/users/restore-password/{{ $user['id'] }}'
                                                        class='btn btn-success waves-effect waves-light'
                                                        data-toggle='tooltip'
                                                        data-placement='top'
                                                        title=''
                                                        data-original-title='Restore Password'
                                                        onclick="return confirm('Confirm restore password for {{ $user['email'] }} ??')"
                                                    >
                                                        <i class="mdi mdi-sync"></i>
                                                    </a>

                                                    <a 
                                                        href='/admin/users/edit/{{ $user['id'] }}'
                                                        class="btn btn-warning waves-effect waves-light"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Edit"
                                                    >
                                                        <i class="ion-edit"></i>
                                                    </a>

                                                    @if ($user['status'] !== 1)
                                                        <a  href='/admin/users/lock/{{ $user['id'] }}'
                                                            class='btn btn-danger waves-effect waves-light'
                                                            data-toggle='tooltip'
                                                            data-placement='top'
                                                            title=''
                                                            data-original-title='Lock'
                                                            onclick="return confirm('Lock: {{ $user['email'] }} ?')"
                                                        >
                                                            <i class="mdi mdi-lock"></i>
                                                        </a>
                                                    @endif

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
