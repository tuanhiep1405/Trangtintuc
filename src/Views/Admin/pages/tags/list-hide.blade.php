@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/tags">Tags</a></li>
                        <li class="breadcrumb-item active">Hide</li>
                    </ol>
                </div>
                <h5 class="page-title">Tags</h5>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card m-b-30">
                            <form action="" method="GET" class="mt-4 d-flex justify-content-between">
                                <div class="card-body">
                                    <h2 class="mb-4">
                                        <span class="badge badge-default"> Tags Hide </span>
                                    </h2>

                                    @include('components.alert')

                                    <div class="d-flex justify-content-between mb-4" style="width: 100%">
                                        <div>
                                            <a href="/admin/tags" class="btn btn-secondary mo-mb-2" data-toggle="tooltip"
                                                data-placement="left" title=""
                                                data-original-title="List Tags">
                                                <i class="dripicons-view-list"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="w-100 mr-2">
                                                <input
                                                    class="form-control"
                                                    type="search"
                                                    placeholder="Search..."
                                                    name="search"
                                                    value="{{ $search }}"
                                                >
                                            </div>
                                            <button type="submit"
                                                class="btn btn-success waves-effect waves-light d-flex align-items-center btn-search">
                                                <i class="ti-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                @php $key = ($page * $perPage) - $perPage + 1; @endphp
                                                @empty($tagsHide)
                                                    <tr>
                                                        <td colspan="3" class="text-center">No Tag Here</td>
                                                    </tr>
                                                @endempty
                                                @foreach ($tagsHide as $item)
                                                    <tr>
                                                            
                                                        <td scope="row">{{ $key }}</td>
                                                        <td>{{$item['nameTag']}}</td>
                                                        <td>
                                                            <a  href="/admin/tags/show/{{$item['id']}}"
                                                                class="btn btn-success waves-effect waves-light"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title=""
                                                                data-original-title="Show"
                                                            >
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <a  href='/admin/tags/delete/{{$item['id']}}'
                                                                class='btn btn-danger waves-effect waves-light'
                                                                data-toggle='tooltip'
                                                                data-placement='top'
                                                                title=''
                                                                data-original-title='Delete'
                                                                onclick="return confirm('Delete ??')"
                                                            >
                                                                <i class="mdi mdi-delete"></i>
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
        </div>
    </div>
@endsection
