@extends('admin.layouts.app')
@section('title','user_list')
{{-- Use original search bar for better UI use yield for different page different serch form --}}
@section('searchbar')
    <form class="form-header" action="{{ route('admin#userList') }}" method="get">
        <input class="au-input au-input--xl" value="{{ request('search') }}" type="text" name="search" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
{{-- Main Contents --}}
@section('content')
<div class="col-md-12">
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="overview-wrap">
                <h2 class="title-1">Admin Lists
            </div>
        </div>
    </div>
    {{-- Condition for CRUD noti session --}}
    @if (session('accDelete'))
        <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
            <strong>{{ session('accDelete') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (count($data) === 0)
        {{-- Condition for no data to show --}}
        @if (!empty(request('search')))
            {{-- Condition search data is not exit --}}
            <h3>There is no Admin Account with {{ request('search') }} <a href="{{ route('admin#list') }}">Back to list</a></h3>
        @endif
    @else
        <div class="table-responsive table-responsive-data2 mb-2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th style="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr class="tr-shadow @if ($row->id === auth()->id()) d-none @endif">
                            <td>
                                @if ($row->image === NULL)
                                    <img style="width:100px; height:100px;" src="{{ asset('admin/images/user (3).jpg') }}"/>
                                 @else
                                    <img style="width:100px; height:100px;" src="{{ asset('storage/'.$row->image) }}"/>
                                @endif
                            </td>
                            <td >
                                {{ $row->name }}
                            </td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>
                                <div  class="table-data-feature d-flex justify-content-start">
                                    <a href="{{ route('admin#userEdit',$row->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="" class="item mx-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- {{ $data->appends(request()->query())->links() }} --}}
    @endif
</div>
@endsection
