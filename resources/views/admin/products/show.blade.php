@extends('admin.layouts.app')
@section('title','pizza_info')
@section('searchbar')
    <form class="form-header" action="" method="POST">
        <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
@section('content')
    <div class="col-lg-10 offset-1">
        @if (session('profileUpdated'))
            <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
                <strong>{{ session('profileUpdated') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body position-relative">
                <div  class="position-absolute top-0 pt-1">
                    <i style="cursor: pointer; font-size:35px;" class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                </div>
                <div class="card-title">
                    <h3 class="text-center title-2">Product Info</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                            <img src="{{ asset('storage/'.$data->image) }}"/>
                    </div>
                    <div class="col-8">
                        <h3 class="my-3">{{ $data->name }}</h3>
                        <div class=" my-3 d-flex gap-2">
                            <div class=" bg-black p-2 rounded-1">
                                <h5 class=" text-white"><i class="fa-solid fa-money-check-dollar"></i> {{ $data->price }}$</h5>
                            </div>
                            <div class=" bg-dark p-2 rounded-1">
                                <h5 class=" text-white"><i class="fa-solid fa-stopwatch"></i> {{ $data->waiting_time }}-min</h5>
                            </div>
                            <div class=" bg-dark p-2 rounded-1">
                                <h5 class=" text-white"><i class="fa-solid fa-book"></i> {{ $data->categories->category_name }}</h5>
                            </div>
                            <div class=" bg-dark p-2 rounded-1">
                                <h5 class=" text-white"><i class="fa-solid fa-street-view"></i> {{ $data->view_count }}</h5>
                            </div>
                            <div class=" bg-dark p-2 rounded-1">
                                <h5 class=" text-white"><i class="fa-solid fa-calendar-days"></i> {{ $data->created_at->format('d-M-Y') }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-11">
                                <h5 class=" mt-3 mb-2"><i class="fa-solid fa-file-invoice"></i> Detail</h5>
                                <p> {{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
