@extends('admin.layouts.app')
@section('title','category_create')
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
                    <h3 class="text-center title-2">Add Your Category</h3>
                </div>
                <hr>
                <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Product-Name...">
                        @error('name')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name='category_id' aria-label="Default select example">
                            <option value="">select pizza category</option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Description</label>
                        <textarea id="cc-pament" rows="8"  name="description" type="text" class="form-control @error('description') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Product-Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Price</label>
                        <input id="cc-pament" name="price" value="{{ old('price') }}" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Product-Price">
                        @error('price')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                        <input id="cc-pament" name="waiting_time" value="{{ old('waiting_time') }}" type="number" class="form-control @error('waiting_time') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Waiting-Time...">
                        @error('waiting_time')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" name="image" id="formFileSm" type="file">
                        @error('image')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if (session('imgUnmatch'))
                            <small class=" text-danger">{{ session('imgUnmatch') }}</small>
                        @endif
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Create</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
