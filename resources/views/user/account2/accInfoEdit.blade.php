@extends('user.layout.master');
@section('pageInfo','Account Info Edit')
@section('category')
    <div class="navbar-nav w-100">
        <a href="" class="nav-item nav-link">There is no category for this page</a>
    </div>
@endsection
@section('searchbar')
    <form action="{{ route('user#home') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for products">
            <div class="input-group-append">
                <span class="input-group-text bg-transparent text-primary">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
    </form>
@endsection
@section('pages')
    <a href="{{ route('user#home') }}" class="nav-item nav-link ">Home</a>
    <a href="{{ route('user#shoppingCartPage') }}" class="nav-item nav-link">My Cart</a>
    <a href="{{ route('user#orderHistory') }}" class="nav-item nav-link ">Orders</a>
    <a href="{{ route('user#contactPage') }}" class="nav-item nav-link">Contact</a>
@endsection
@section('content')
<!-- main Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Our Products</span></h5>
            <div class="bg-light p-4 mb-30">
                @foreach ($products as $product)
                <div class=" custom-checkbox d-flex align-items-center mb-2">
                    <a href="{{ route('user#productDetail',$product->id) }}">
                        <img class="" style="width:90px; height:90px;" src="{{ asset('storage/'.$product->image) }}"/>
                    </a>
                    <a href="{{ route('user#productDetail',$product->id) }}"><span class=" h6 ml-2 block-email">{{ $product->name }}</span></a>
                </div>
                @endforeach
                <div class=" d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
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
                            <form action="{{ route('user#accountInfoUpdate',$data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (auth()->user()->image === NULL)
                                            <img src="{{ asset('admin/images/user (3).jpg') }}" alt="{{ auth()->user()->name }}" />
                                        @else
                                            <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" />
                                        @endif
                                        <div class="mt-3">
                                            <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button class="btn bg-dark w-100 text-white mt-3"><i class="fa-solid fa-cloud-arrow-up"></i> Update Profile</button>
                                    </div>
                                    <div class="col-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input class="au-input au-input--full" type="text" name="name" placeholder="Username" value="{{ old('name',$data->name) }}">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{ old('email',$data->email) }}">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="au-input au-input--full" type="number" name="phone" placeholder="09xxx" value="{{ old('phone',$data->phone) }}">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-select" name='gender' aria-label="Default select example">
                                                    <option value="Rather not to say">Select your gender</option>
                                                    <option value="Male" @if ($data->gender==='Male') selected @endif>Male</option>
                                                    <option value="Female" @if ($data->gender==='Female') selected @endif>Female</option>
                                                    <option value="Other" @if ($data->gender==='Other') selected @endif>Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input class="au-input au-input--full" type="text" name="address" placeholder="address" value="{{ old('address',$data->address) }}">
                                                @error('address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Role <small>( disable no asset to change )</small></label>
                                                <input class="au-input au-input--full" type="text" name="role" value="{{ $data->role }}" disabled readonly>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>

@endsection
