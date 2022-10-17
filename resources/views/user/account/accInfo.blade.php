@extends('user.layout.master');
@section('pageInfo','Account Info')
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
                                    <a class=" text-black" href="{{ route('user#home') }}"><i style="cursor: pointer; font-size:35px;" class="fa-solid fa-arrow-left" ></i></a>
                                </div>
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (auth()->user()->image === NULL)
                                        <img src="{{ asset('admin/images/user (3).jpg') }}" alt="{{ auth()->user()->name }}" />
                                    @else
                                        <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" />
                                    @endif
                                    <div class="row">
                                        <div class="col-8 offset-2 text-center">
                                            <a class=" w-100" href="{{ route('user#accountInfoEdit',auth()->id()) }}">
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
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>

@endsection
