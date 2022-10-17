@extends('admin.layouts.app')
@section('title','edit_account_info')
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
                    <h3 class="text-center title-2">Account Profile</h3>
                </div>
                <hr>
                <form action="{{ route('admin#accountInfoUpdate',$data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4 offset-1">
                            @if ($data->image === NULL)
                                <img src="{{ asset('admin/images/user (3).jpg') }}"/>
                            @else
                                <img src="{{ asset('storage/'.$data->image) }}"/>
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
                                    <label>Role</label>
                                    <select class="form-select" name='role' aria-label="Default select example">
                                        <option value="admin" @if ($data->role==='admin') selected @endif>admin</option>
                                        <option value="user" @if ($data->role==='user') selected @endif>user</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
