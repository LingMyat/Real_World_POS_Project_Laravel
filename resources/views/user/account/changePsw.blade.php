@extends('user.layout.master');
@section('pageInfo','Change Password')
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
        <div class="col-lg-4 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Rules For Password Changing</span></h5>
            <div class="bg-light p-4 mb-30">
                    <div class="custom-control custom-checkbox d-flex align-items-center  mb-3">
                        <span ><b>-</b>The current password you fill in form must be match with your old password .</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center  mb-3">
                        <span ><b>-</b>All form field need to fill .</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center  mb-3">
                        <span ><b>-</b>Your new password must be 6 or more characters .</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center  mb-3">
                        <span ><b>-</b>Your new password and confirm password must be same .</span>
                    </div>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-8 col-md-8">
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title position-relative">
                                <div  class="position-absolute">
                                    <i style="cursor: pointer; font-size:35px;" class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                                </div>
                                <h3 class="text-center title-2">Password-Update</h3>
                            </div>
                            <hr>
                            <form action="{{ route('user#changePassword',auth()->user()->id) }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Current-Password</label>
                                    <input id="cc-pament" name="currentPassword" type="password" class="form-control
                                    @if (session('notMatch')) is-invalid @endif
                                    @error('currentPassword') is-invalid @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="Enter Current Password">
                                    @error('currentPassword')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (session('notMatch'))
                                        <div class=" invalid-feedback">{{ session('notMatch') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New-Password</label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                    @error('newPassword')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm-Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                                    @error('confirmPassword')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-warning btn-block">
                                        <i class="fa-solid fa-key me-1"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                    </button>
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
