@extends('admin.layouts.app')
@section('title','password_change')
@section('searchbar')
    <form class="form-header" action="" method="POST">
        <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
@section('content')
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Password</h3>
                </div>
                <hr>
                <form action="{{ route('admin#changePassword',auth()->user()->id) }}" method="post" novalidate="novalidate">
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
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa-solid fa-key me-1"></i>
                            <span id="payment-button-amount">Change Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
