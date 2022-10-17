@extends('user.layout.master');
@section('pageInfo','Shop List')
@section('category')
    <div class="navbar-nav w-100">
        <a href="{{ route('user#home') }}" class="nav-item nav-link">All</a>
        @foreach ($category as $row)
            <a href="{{ route('user#filter',$row->id) }}" class="nav-item nav-link">{{ $row->category_name }}</a>
        @endforeach
    </div>
@endsection
@section('searchbar')
    <form action="{{ route('user#home') }}" method="get">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search for products">
            <div class="input-group-append">
                <button class="input-group-text bg-transparent text-primary">
                    <span>
                        <i class="fa fa-search"></i>
                    </span>
                </button>
            </div>
        </div>
    </form>
@endsection
@section('pages')
    <a href="{{ route('user#home') }}" class="nav-item nav-link active">Home</a>
    <a href="{{ route('user#shoppingCartPage') }}" class="nav-item nav-link ">My Cart</a>
    <a href="{{ route('user#orderHistory') }}" class="nav-item nav-link ">Orders</a>
    <a href="{{ route('user#contactPage') }}" class="nav-item nav-link">Contact</a>
@endsection
@section('content')
<!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                        <div class="custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <a href="" class=" text-black" for="price-all">All Price</a>
                            <small class=" p-1 rounded-1 border ">1000</small>
                        </div>

                        <div class=" custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input class="helperPrice" type="hidden" name="" value="0">
                            <button href="" class="sort-price text-black" for="price-1">$0 - $10</button>
                            <small class=" p-1 rounded-1 border ">150</small>
                        </div>
                        <div class=" custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input class="helperPrice" type="hidden" name="" value="10">
                            <button href="" class="sort-price text-black" for="price-2">$10 - $20</button>
                            <small class=" p-1 rounded-1 border ">295</small>
                        </div>
                        <div class=" custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input class="helperPrice" type="hidden" name="" value="20">
                            <button href="" class="sort-price text-black" for="price-3">$20 - $30</button>
                            <small class=" p-1 rounded-1 border ">246</small>
                        </div>
                        <div class=" custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input class="helperPrice" type="hidden" name="" value="30">
                            <button href="" class="sort-price text-black" for="price-4">$30 - $40</button>
                            <small class=" p-1 rounded-1 border ">145</small>
                        </div>
                        <div class=" custom-checkbox d-flex align-items-center justify-content-between">
                            <input class="helperPrice" type="hidden" name="" value="40">
                            <button href="" class="sort-price text-black" for="price-5">$40 - $50</button>
                            <small class=" p-1 rounded-1 border ">168</small>
                        </div>
                </div>

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a data-toggle="tooltip" data-placement="bottom" title="Cart" href="{{ route('user#shoppingCartPage') }}">
                                    <button class="btn btn-sm position-relative btn-light"><i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded bg-danger">
                                            {{ $qty }}
                                        </span>
                                    </button>
                                </a>
                                <a data-toggle="tooltip" data-placement="bottom" title="Orders" href="{{ route('user#orderHistory') }}">
                                    <button class="btn btn-sm position-relative btn-light ml-2"><i class="fa fa-bars"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded bg-danger">
                                            {{ count($order) }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            @if (session('pswUpdated'))
                                <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
                                    <strong>{{ session('pswUpdated') }} <a href="{{ route('auth#logoutPage') }}">click here to check !</a></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session('profileUpdated'))
                                <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
                                    <strong>{{ session('profileUpdated') }}</a></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session('messageSend'))
                                <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
                                    <strong>{{ session('messageSend') }}</a></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" id="first" href="{{ route('user#sorting') }}">Newest</a>
                                        <a class="dropdown-item" href="{{ route('user#home') }}">Latest</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">12</a>
                                        <a class="dropdown-item" href="#">All</a>
                                        <a class="dropdown-item" href="#">Normal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($data) == 0)
                        {{-- Condition for no data to show --}}
                        @if (!empty(request('search')))
                        {{-- Condition search data is not exit --}}
                        <h3>There is no Product with {{ request('search') }} <a href="{{ route('user#home') }}">Back to home</a></h3>
                        @else
                        {{-- Condition there is no data exit in database --}}
                        <h3>There is no Product with this category <a href="{{ route('user#home') }}">Back to home</a> </h3>
                        @endif
                    @else
                        <div class="row" id="data_container">
                            @foreach ($data as $row)
                                <div class="col-lg-4 col-md-6 col-sm-6" id="data_list">
                                    <div class="product-item bg-light mb-3">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/'.$row->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail',$row->id) }}"><i class="fa-solid fa-ellipsis"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-1">
                                            <a class="h5 text-decoration-none text-truncate" href="">{{ $row->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-1">
                                                <h4>${{ $row->price }}.00</h4><h6 class="text-muted ml-2"><del>${{ $row->price + 4 }}.00</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-1 mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class=" d-flex justify-content-between">
                                <small class="">
                                    Showing <b>{{ $data->firstItem() }}</b> to <b>{{ $data->lastItem() }}</b> of <b>{{ $data->total() }}</b> results
                                </small>
                                <div class="">
                                    {{ $data->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
<!-- Shop End -->

@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){
            let sortPrice = document.getElementsByClassName('sort-price');
            let helperPrice = document.getElementsByClassName('helperPrice');
            let sortingPrice = function(v1,v2){
                $.ajax({
                        type : 'get',
                        url : '/ajax/sort/price',
                        data : {'val1':v1,'val2':v2},
                        dataType : 'json',
                        success : function(response){
                            $list = '';
                            for (let i = 0; i < response.length; i++) {
                                $id = response[i].id;
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6" id="data_list">
                                    <div class="product-item bg-light mb-3">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="product/detail/${response[i].id}"><i class="fa-solid fa-ellipsis"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-1">
                                            <a class="h5 text-decoration-none text-truncate" href="">${ response[i].name }</a>
                                            <div class="d-flex align-items-center justify-content-center mt-1">
                                                <h4>$${response[i].price }.00</h4><h6 class="text-muted ml-2"><del>$${ response[i].price + 4 }.00</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-1 mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                console.log(response[i].id);
                            }

                            $('#data_container').html($list);
                    }
                })
            };
            for (let i = 0; i < sortPrice.length; i++) {
                sortPrice[i].addEventListener('click',function(){
                    let helperPriceValue = Number(helperPrice[i].value);
                    sortingPrice(helperPriceValue,(helperPriceValue + 10));
                });
            }
        });
    </script>
@endsection
