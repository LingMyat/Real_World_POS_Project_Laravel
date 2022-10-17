@extends('user.layout.master');
@section('pageInfo','Contact')
@section('category')
    <div class="navbar-nav w-100">
        <a href="" class="nav-item nav-link">There is no category for this page</a>
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
    <a href="{{ route('user#home') }}" class="nav-item nav-link">Home</a>
    <a href="{{ route('user#shoppingCartPage') }}" class="nav-item nav-link ">My Cart</a>
    <a href="{{ route('user#orderHistory') }}" class="nav-item nav-link ">Orders</a>
    <a href="{{ route('user#contactPage') }}" class="nav-item nav-link active">Contact</a>
@endsection
@section('content')
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('user#message') }}" method="post">
                        @csrf
                        <div class="control-group mb-3">
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="control-group mb-3">
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="control-group mb-3">
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" value="{{ old('subject') }}"/>
                            <p class="help-block text-danger"></p>
                            @error('subject')
                                <span class=" text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group mb-3">
                            <textarea class="form-control" name="message" rows="8" id="message" placeholder="Message">{{ old('message') }}</textarea>
                            @error('Message')
                                <span class=" text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-warning py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29608.03253165286!2d96.0835502765581!3d21.934395122935356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6d7e63b3951f%3A0xf056698093a6abfc!2sChanmyathazi%2C%20Mandalay!5e0!3m2!1sen!2smm!4v1665749044548!5m2!1sen!2smm"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Mandalay , Myanmar</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>bizkits223@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+959 459 192 583</p>
                </div>
            </div>
        </div>
    </div>
@endsection
