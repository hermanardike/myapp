@extends('layout.app')
@section('title', 'Show database')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Owl Carousel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Modules</a></div>
                <div class="breadcrumb-item">Owl Carousel</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Owl Carousel</h2>
            <p class="section-lead">Display multiple images alternately within a few seconds.</p>

            <div class="row">
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{$upload->upload_name}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="owl-carousel owl-theme slider" id="slider1">
                                <div><img alt="image" src="{{asset('storage/'.Auth::user()->id . '/' . $upload->upload_path)}}"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
