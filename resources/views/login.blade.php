@extends('layouts.master')
@section('title','Login')
@section('content')
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('admin/images/icon/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
