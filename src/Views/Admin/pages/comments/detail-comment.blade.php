@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/comments">Comments</a></li>
                        <li class="breadcrumb-item"><a href="/admin/comments/list/{{ $idPost }}">Detailt Post</a></li>
                        <li class="breadcrumb-item active">Detailt Comment</li>
                    </ol>
                </div>
                <h5 class="page-title">Detail Comment</h5>
            </div>
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mb-4">
                            <span class="badge badge-default"> Detail Comment </span>
                        </h2>
                        @include('components.alert')
                        <div class="d-flex justify-content-between mb-4" style="width: 100%">
                            <div></div>
                            @include('components.table.search')
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 10%">Username</th>
                                        <th style="width: 10%">Image</th>
                                        <th style="width: 50%">Content</th>
                                        <th style="width: 10%; text-align: center">Reply Username</th>
                                        <th style="width: 15%">Submited On</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @empty($detail)
                                        <tr>
                                            <td colspan="7" class="text-center">No Reply Comment Here</td>
                                        </tr>
                                    @endempty
                                    @foreach ($detail as $index => $dt)
                                        <tr>
                                            <th>{{$index + 1}}</th>
                                            <td>
                                            {{$dt['name']}}
                                            </td>
                                            <td>
                                                <img src="/assets/{{$dt['avatar']}}" alt="" width="80" height="80"
                                                    style=" object-fit: cover;
                                                            border-radius: 4px;
                                                            box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2);
                                                            ">
                                            </td>
                                            <td>
                                                <p
                                                    style="
                                                            font-size: 1rem;
                                                            background-color: #eff3f6;
                                                            color: #0a1832;
                                                            padding: 8px 16px;
                                                            text-align: justify;
                                                            border-radius: 8px;">
                                                    {{$dt['content']}}
                                                </p>
                                            </td>
                                            <td style="text-align: center">
                                                <label for="">{{$dt['rpName']}}</label>
                                            </td>
                                            <td>
                                                <label for="">{{$dt['date']}}</label>
                                            </td>
                                            <td>
                                                <form action="" method="POST">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger waves-effect waves-light"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete"
                                                        onclick="return confirm('Delete Reply Comment {{ $index + 1 }} ??')"
                                                        name="btn-delete-reply"
                                                        value="{{ $dt['id'] }}"
                                                    >
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
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
@endsection
