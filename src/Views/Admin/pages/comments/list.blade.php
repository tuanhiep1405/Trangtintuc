@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/comments">Comments</a></li>
                        <li class="breadcrumb-item active">Detailt Post</li>
                    </ol>
                </div>
                <h5 class="page-title">Comments</h5>
            </div>
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mb-4">
                            <span class="badge badge-default"> Comments </span>
                        </h2>
                        @include('components.alert')
                        <div class="d-flex justify-content-between mb-4" style="width: 100%">
                            <div class="d-flex">
                            </div>
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
                                        <th style="width: 10%; text-align: center">Reply</th>
                                        <th style="width: 15%">Submited On</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @empty($comments)
                                        <tr>
                                            <td colspan="6" class="text-center">No Comments Here</td>
                                        </tr>
                                    @endempty
                                    @foreach ($comments as $index => $comment)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <td>
                                                {{ $comment['name'] }}
                                            </td>
                                            <td>
                                                <img src="/assets/{{ $comment['avatar'] }}" alt="" width="80"
                                                    height="80"
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
                                                    {{ $comment['content'] }}
                                                </p>
                                            </td>
                                            <td style="text-align: center">
                                                @if ($comment['totalReply'])
                                                    <a
                                                        href="/admin/comments/detail-comment/{{ $idPost }}/{{ $comment['id'] }}"
                                                        type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Reply: {{ $comment['totalReply'] }}"
                                                    >
                                                        <i
                                                            class="mdi mdi-comment-text-outline"
                                                            style="font-size: 34px; color: green"
                                                        >
                                                        </i>
                                                    </a>
                                                @else
                                                    <a href="#!" type="submit" data-toggle="tooltip"
                                                        data-placement="top" title="No Reply">
                                                        <i class="mdi mdi-comment-remove-outline"
                                                            style="font-size: 34px; color: red"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <label for="">{{ $comment['date'] }}</label>
                                            </td>
                                            <td>
                                                <form action="" method="POST">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger waves-effect waves-light" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Delete"
                                                        onclick="return confirm('Delete comment {{ $index + 1 }}??')"
                                                        name="btn-delete-comment"
                                                        value="{{ $comment['id'] }}"
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
