@extends('admin.layouts.app')
@section('title','edit_product_info')
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
                    <h3 class="text-center title-2">Edit Product Info</h3>
                </div>
                <hr>
                <form action="{{ route('product#update',$data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4 offset-1">
                                <img src="{{ asset('storage/'.$data->image) }}" alt="{{ auth()->user()->name }}" />
                            <div class="mt-3">
                                <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn bg-dark w-100 text-white mt-3"><i class="fa-solid fa-cloud-arrow-up"></i> Update</button>
                        </div>
                        <div class="col-6">
                                <div class="form-group">
                                    <label>Pizza Name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Pizza Name" value="{{ old('name',$data->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" name='category_id' aria-label="Default select example">
                                        @foreach ($category as $row)
                                            <option value="{{ $row->id }}" @if ($row->id===$data->category_id)selected @endif>{{ $row->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="" class=" form-control" rows="9">{{ old('description',$data->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="au-input au-input--full" type="number" name="price" placeholder="Product Price" value="{{ old('price',$data->price) }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Waiting Time</label>
                                    <input class="au-input au-input--full" type="number" name="waiting_time" placeholder="Waiting Time" value="{{ old('waiting_time',$data->waiting_time) }}">
                                    @error('waiting_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>View Count <small>( disable no asset to change )</small></label>
                                    <input class="au-input au-input--full" type="text" name="view_count" value="{{ $data->view_count }}" disabled readonly>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
