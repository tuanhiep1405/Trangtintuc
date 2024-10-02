@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
                <h5 class="page-title">Categories</h5>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Add Category </span>
                                </h2>
                                <form action="/admin/categories" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="d-block">Name</label>
                                        <input class="form-control" type="text" placeholder="Name Category..."
                                            name="nameCategory">
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light float-right"
                                        name="btn-add">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Categories </span>
                                </h2>
                                @include('components.alert')
                                <div class="d-flex justify-content-between mb-4" style="width: 100%">
                                    <div>
                                        <a href="/admin/categories/list-hide" class="btn btn-danger mo-mb-2"
                                            data-toggle="tooltip" data-placement="left" title=""
                                            data-original-title="List Categories Hiden">
                                            <i class="mdi mdi-playlist-remove"></i>
                                        </a>
                                    </div>
                                    <div></div>
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
                                            @foreach ($categories as $index => $category)
                                                <tr>
                                                    <th>{{ $index + 1 }}</th>
                                                    <td>{{ $category['nameCategory'] }}</td>
                                                    <td>
                                                        <a href='/admin/categories/edit/{{ $category['id'] }}'
                                                            class="btn btn-warning waves-effect waves-light"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Edit">
                                                            <i class="ion-edit"></i>
                                                        </a>

                                                        <a href='/admin/categories/hide/{{ $category['id'] }}'
                                                            class='btn btn-danger waves-effect waves-light'
                                                            data-toggle='tooltip' data-placement='top' title=''
                                                            data-original-title='Hide'
                                                            onclick="return confirm('Hide {{ $category['nameCategory'] }}?')">
                                                            <i class="mdi mdi-eye-off"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
