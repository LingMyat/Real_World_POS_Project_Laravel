@extends('admin.layouts.app')
@section('title','category_edit')
@section('searchbar')
    <form class="form-header" action="" method="POST">
        <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
@section('content')
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Category Form</h3>
                </div>
                <hr>
                <form action="{{ route('category#update',$data->id) }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Create Your Category</label>
                        <input id="cc-pament" value="{{ $data->category_name }}" name="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                        @error('category_name')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Save</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
