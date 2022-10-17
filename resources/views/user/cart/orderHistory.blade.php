@extends('user.layout.master');
@section('pageInfo','Order')
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
    <a href="{{ route('user#shoppingCartPage') }}" class="nav-item nav-link ">My Cart</a>
    <a href="{{ route('user#orderHistory') }}" class="nav-item nav-link active">Orders</a>
    <a href="{{ route('user#contactPage') }}" class="nav-item nav-link">Contact</a>
@endsection
@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order_Id</th>
                            <th>Total_Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $row)
                            <tr class=" product-row">
                                <td class="align-middle"> {{ $row->created_at->format('d-m-Y / H:i A') }}</td>
                                <td class="align-middle">{{ $row->order_code }}</td>
                                <td class="align-middle tableEachTotal">${{ $row->total }}.00</td>
                                <td class="align-middle">
                                    @if ($row->status == 0)
                                        <span class="">pending..</span>
                                    @elseif ($row->status == 1)
                                        <span>order success</span>
                                    @elseif ($row->status == 2)
                                        <span>order reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h4 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Our Process</span></h4>
                <div class="bg-light p-30 mb-5">
                    <p class=" mb-2">
                        - <b>pending</b> means we are start preparing your order now.
                    </p>
                    <p class=" mb-2">
                        - <b>success</b> means your order is ready to deliver to your place.
                    </p>
                    <p class=" mb-2">
                        - <b>reject</b> means there is one of product that you ordered is unavailable.
                    </p>
                    <p>
                        - if you have any problem with your orders you can contact to Customer-Sevice.
                    </p>
                </div>
            </div>
        </div>
    </div>
<!-- Cart End -->
@endsection

