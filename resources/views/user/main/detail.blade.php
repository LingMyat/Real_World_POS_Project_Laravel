@extends('user.layout.master');
@section('pageInfo','Product-Detail')
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
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Review section</span></h5>
                <div class="bg-light p-4 mb-30">
                   <div class=" mb-2">
                        <b>-</b> leave your review here
                   </div>
                   <div class="mb-2">
                        <b>-</b> please give us honest reviews
                    </div>
                    <div class="mb-2">
                        <b>-</b> if u got some problems then
                    </div>
                    <div class="mb-2">
                        <b>-</b> contact customer service
                    </div>
                    <div class="mb-2">
                        <b>-</b> we emphasizes our customers
                    </div>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->

            <div class="col-lg-9 col-md-8">
                    <div class="col mb-0">
                        <div class="container-fluid pb-2">
                            <div class="row">
                                <div class="col-6 mb-30">
                                    <img src="{{ asset('storage/'.$data->image) }}" alt="">
                                </div>

                                <div class="col-lg-6 h-auto mb-30">
                                    <div class="h-100 bg-light p-30">
                                        <h3>{{ $data->name }}</h3>
                                        <div class="d-flex mb-3">
                                            <div class="text-primary mr-2">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star-half-alt"></small>
                                                <small class="far fa-star"></small>
                                            </div>
                                            <small class="pt-1">( <b>{{ $data->view_count + 1}}</b> - Views )</small>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h3 class="font-weight-semi-bold">${{ $data->price }}.00</h3><h5 class="text-muted ml-2"><del>${{ $data->price + 4 }}.00</del></h5>
                                        </div>
                                        <p class="mb-4">{{ $data->description }}</p>
                                        <div class="d-flex align-items-center mb-3 pt-2">
                                            <div class="input-group d-flex quantity mr-3" style="width: 130px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-warning h-100 btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input id="Product_qty" type="text" class=" form-control bg-secondary border-0 text-center" value="1">
                                                <input class=" d-none" type="text" id='user' value="{{ Auth::user()->id }}">
                                                <input class=" d-none" type="text" id='product' value="{{ $data->id }}">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-warning h-100 btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button class="btn btn-addToCart btn-warning px-3 me-3"><i class="fa fa-shopping-cart mr-1 " ></i> Add To
                                                Cart</button>
                                            <a href="{{ route('user#home') }}" class="btn btn-warning"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                        </div>
                                        <div class="d-flex pt-2">
                                            <strong class="text-dark mr-2">Share on:</strong>
                                            <div class="d-inline-flex">
                                                <a class="text-dark px-2" href="">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                                <a class="text-dark px-2" href="">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                                <a class="text-dark px-2" href="">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                                <a class="text-dark px-2" href="">
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col px-5">
                        <div class="">
                            <div class="bg-light p-30">
                               <h4 class="mb-3">Reviews</h4>
                                <div class="">
                                    @foreach ($reviews as $row)
                                        <div class=" mb-2">
                                            <div class=" mb-0">
                                                @if ($row->image === NULL)
                                                    <img style="width:35px; height:35px;" class="  rounded-circle" src="{{ asset('admin/images/user (3).jpg') }}"/>
                                                 @else
                                                    <img style="width:35px; height:35px;" class="  rounded-circle" src="{{ asset('storage/'.$row->image) }}"/>
                                                @endif
                                                <b>{{ $row->name }}</b>
                                            </div>
                                            <div class=" d-flex justify-content-between ps-5">
                                                <small>{{ $row->description }}</small>
                                                <small>{{ $row->created_at }}</small>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('user#reviewSend') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="product_id" value="{{ $data->id }}">
                                <input id="cc-pament" name="description" type="text" class="form-control">
                                <button id="payment-button" type="submit" class="btn btn-warning ">
                                    <i class="fa-solid fa-location-arrow"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
            <!-- Shop Product End -->
            <div style="" class="container-fluid py-4">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
                <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">These Items Are Same Category with {{ $data->name }}</span></h4>
                <div class="row px-xl-5">
                    @foreach ($relatedProducts as $row)
                        <div class="col-lg-3 col-md-4 col-sm-6" id="data_list">
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
                </div>
            </div>
    </div>
    </div>


@endsection
@section('scriptSource')
<script>
     $(document).ready(function(){
        console.log($('#product').val());
        $.ajax({
            type : 'get',
            url : '/ajax/viewCount',
            data : {'product_id':$('#product').val()},
            dataType: 'json',
        })

        // add to cart
        $('.btn-addToCart').click(function(){
            $result = {
                'user_id' : Number($('#user').val()),
                'product_id' : Number($('#product').val()),
                'qty' : $('#Product_qty').val()
            }
            $.ajax({
                type : 'get',
                url : '/ajax/addToCart',
                data : $result,
                dataType: 'json',
                success : function(response){
                    if (response.status == 'success') {
                        window.location.href = 'http://127.0.0.1:8000/user/home';
                    }
                }
            })
        })
    });
</script>
@endsection
