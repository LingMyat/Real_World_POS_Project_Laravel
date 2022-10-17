@extends('admin.layouts.app')
@section('title','account_info')
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
        <div class="card">
            <div class="card-body">
                <div class="card-title position-relative">
                    <div  class="position-absolute">
                        <i style="cursor: pointer; font-size:35px;" class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                    </div>
                    <h3 class="text-center title-2">Account Profile</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3 offset-2">
                        @if (auth()->user()->image === NULL)
                            <img src="{{ asset('admin/images/user (3).jpg') }}" alt="{{ auth()->user()->name }}" />
                        @else
                            <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" />
                        @endif
                        <div class="row">
                            <div class="col-3 offset-2 text-center">
                                <a href="{{ route('admin#accountInfoEdit',auth()->user()->id) }}">
                                    <button class="btn bg-dark text-white mt-3"><i class="fa-solid fa-file-pen"></i> Edit Profile</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 offset-1">
                        <h4 class=" my-3"><i class="fa-solid fa-file-signature"></i> {{ auth()->user()->name }}</h4>
                        <h4 class=" my-3"><i class="fa-solid fa-envelope-open-text"></i> {{ auth()->user()->email }}</h4>
                        <h4 class=" my-3"><i class="fa-solid fa-square-phone-flip"></i> {{ auth()->user()->phone }}</h4>
                        <h4 class=" my-3"><i class="fa-solid fa-venus-mars"></i> {{ auth()->user()->gender }}</h4>
                        <h4 class=" my-3"><i class="fa-solid fa-earth-asia"></i> {{ auth()->user()->address }}</h4>
                        <h4 class=" my-3"><i class="fa-solid fa-calendar-days"></i> Created_at {{ auth()->user()->created_at->format('d-M-Y') }}</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
