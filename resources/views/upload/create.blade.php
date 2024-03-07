@extends('layout.app')
@section('title','Upload FIle Image')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Upload File Management</h1>
            <div class="section-header-button">
                <a href="{{route('upload.create')}}" class="btn btn-primary">add upload</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">upload</a></div>
                <div class="breadcrumb-item">All upload</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">uploads</h2>
            <p class="section-lead">
                You can manage all posts, such as editing, deleting and more.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>upload</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Simple Summernote</h4>
                                    </div>
                                    <div class="card-body">
                                        <form  method="POST" enctype="multipart/form-data"  action="{{route('upload.store')}}">
                                            @csrf
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">upload_name</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="upload_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">upload_image</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button class="btn btn-primary">Publish</button>
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
    </section>
@endsection
@section('sidebar')
    @parent
    <li class="menu-header">Starter</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
        </ul>
    </li>
@endsection


