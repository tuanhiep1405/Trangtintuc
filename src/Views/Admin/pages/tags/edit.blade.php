@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/tags">Tags</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h5 class="page-title">Edit Tag</h5>
                
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    
                                    <span class="badge badge-default"> Edit Tag </span>
                                </h2>
                                @include('components.alert')

                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="d-block">ID</label>
                                        <input class="form-control" type="text" name="id" value="{{ $tags['id'] }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Name</label>
                                        <input class="form-control" type="text" placeholder="Name Tag..." name="nameTag" value="{{ $tags['nameTag'] }}">
                                    </div>


                                    {{-- <div class="form-group">
                                        <label class="d-block">Image</label>
                                        <input type="file" name="image" accept="image/*">
                                    </div> --}}
                                    <button name="btn-edit" type="submit" class="btn btn-warning waves-effect waves-light float-right">
                                        Edit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
