@extends('layouts.master')

@section('css')
    <!-- Summernote css -->
    <link href="/assets/admin/assets/plugins/summernote/summernote-bs4.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/posts">Posts</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h5 class="page-title">Posts</h5>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">
                            <span class="badge badge-default"> Edit Post </span>
                        </h2>
                        <img src="{{ show_upload($data['image']) }}" alt="" width="80" height="80"
                            style=" object-fit: cover;
                                    border-radius: 4px;
                                    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2);
                                    margin-bottom: 16px
                                    ">
                        @include('components.alert')
                        
                        <form action="/admin/posts/edit/{{ $data['id'] }}" method="POST" enctype="multipart/form-data"
                            class="mt-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="d-block">Content</label>
                                        <div class="summernote">{!! $data['content'] !!}</div>
                                        <textarea id="postContent" name="content" style="display:none;"></textarea>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="d-block">Title</label>
                                        <input class="form-control" type="text" placeholder="Title Post..."
                                            name="title" value="{{ $data['title'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Description</label>
                                        <input class="form-control" type="text" placeholder="Description Post..."
                                            value="{{ $data['description'] }}" name="description">
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Image</label>
                                        <input type="file" name="image" accept="image/*" value="{{ $data['image'] }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="d-block" for="">Name Category</label>
                                                <select class="form-control" name="idCategory">
                                                    @foreach ($cate as $ct)
                                                        <option value="{{ $ct['id'] }}"
                                                            {{ $data['idCategory'] == $ct['id'] ? 'selected' : '' }}>
                                                            {{ $ct['nameCategory'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="d-block" for="">Type</label>
                                                <select class="form-control" name="idType">
                                                    @foreach ($type as $tp)
                                                        <option value="{{ $tp['id'] }}"
                                                            {{ $data['idType'] == $tp['id'] ? 'selected' : '' }}>
                                                            {{ $tp['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-warning waves-effect waves-light float-right mt-8"
                                        name="btn-edit"
                                        style="
                                            position: absolute;
                                            bottom: 0;
                                            right: 0;
                                        ">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <!--Summernote js-->
    <script src="/assets/admin/assets/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            $(".summernote").summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true, // set focus to editable area after initializing summernote
            });
            // subbmit form
            $('form').on('submit', function(e) {
                var content = $('.summernote').summernote('code');
                $('#postContent').val(content);
            });
        });
    </script>
@endsection
